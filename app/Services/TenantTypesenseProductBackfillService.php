<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use RuntimeException;
use Throwable;

class TenantTypesenseProductBackfillService
{
    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
        private PricingService $pricingService,
        private TypeSenseClient $typeSenseClient,
    ) {}

    /**
     * @param  null|callable(array{processed:int,upserted:int,failed:int}):void  $onProgress
     * @return array{
     *     mode:string,
     *     processed:int,
     *     upserted:int,
     *     failed:int,
     *     deleted:int,
     *     stale_deleted:int,
     *     inactive_deleted:int
     * }
     */
    public function reindexTenant(int $tenantId, int $chunkSize = 100, string $mode = 'full', ?callable $onProgress = null): array
    {
        if ($tenantId < 1) {
            throw new RuntimeException('Tenant id is required.');
        }

        if (! in_array($mode, ['full', 'incremental'], true)) {
            throw new RuntimeException('Invalid reindex mode. Expected "full" or "incremental".');
        }

        $tenant = Tenant::query()->find($tenantId);

        if (! $tenant instanceof Tenant) {
            throw new RuntimeException("Tenant {$tenantId} not found.");
        }

        $resolvedChunkSize = max(1, $chunkSize);
        $previousTenant = $this->tenantContext->getTenant();

        $processed = 0;
        $upserted = 0;
        $failed = 0;
        $sourceActiveIds = [];
        $sourceInactiveIds = [];
        $maxSeenDateUpd = null;

        try {
            $this->tenantContext->setTenant($tenant);

            if (! $this->tenantPrestaShopConnection->connect($tenant)) {
                throw new RuntimeException("Unable to connect tenant {$tenantId} PrestaShop database.");
            }

            $productTable = $this->tenantPrestaShopConnection->table('product');
            $productLangTable = $this->tenantPrestaShopConnection->table('product_lang');
            $manufacturerTable = $this->tenantPrestaShopConnection->table('manufacturer');
            $categoryProductTable = $this->tenantPrestaShopConnection->table('category_product');
            $hasDateUpdColumn = Schema::connection('tenant_ps')->hasColumn($productTable, 'date_upd');
            $watermarkKey = $this->watermarkCacheKey($tenantId);
            $previousWatermark = $mode === 'incremental' && $hasDateUpdColumn
                ? Cache::get($watermarkKey)
                : null;
            $runMode = $mode === 'incremental' && $hasDateUpdColumn && is_string($previousWatermark) && $previousWatermark !== ''
                ? 'incremental'
                : 'full';

            $this->typeSenseClient->ensureCollectionExists($tenantId);
            $existingDocumentIds = $runMode === 'full'
                ? $this->typeSenseClient->listProductDocIds($tenantId)
                : [];

            $query = DB::connection('tenant_ps')
                ->table($productTable.' as p')
                ->leftJoin($manufacturerTable.' as m', 'm.id_manufacturer', '=', 'p.id_manufacturer')
                ->select([
                    'p.id_product',
                    'p.reference',
                    'p.active',
                    ...($hasDateUpdColumn ? ['p.date_upd'] : []),
                    DB::raw("COALESCE(m.name, '') as manufacturer_name"),
                ]);

            if ($runMode === 'incremental') {
                $query->where('p.date_upd', '>', $previousWatermark);
            }

            $query->orderBy('p.id_product')
                ->chunk($resolvedChunkSize, function ($rows) use (
                    &$processed,
                    &$upserted,
                    &$failed,
                    &$sourceActiveIds,
                    &$sourceInactiveIds,
                    &$maxSeenDateUpd,
                    $tenantId,
                    $productLangTable,
                    $categoryProductTable
                ): void {
                    foreach ($rows as $row) {
                        $processed++;
                        $productId = (int) ($row->id_product ?? 0);

                        if ($productId < 1) {
                            $failed++;

                            continue;
                        }

                        if (is_scalar($row->date_upd ?? null)) {
                            $resolvedDateUpd = trim((string) $row->date_upd);

                            if ($resolvedDateUpd !== '' && ($maxSeenDateUpd === null || $resolvedDateUpd > $maxSeenDateUpd)) {
                                $maxSeenDateUpd = $resolvedDateUpd;
                            }
                        }

                        if (! (bool) ($row->active ?? false)) {
                            $sourceInactiveIds[] = (string) $productId;

                            continue;
                        }

                        try {
                            $document = $this->buildProductDocument(
                                tenantId: $tenantId,
                                productId: $productId,
                                reference: (string) ($row->reference ?? ''),
                                manufacturerName: (string) ($row->manufacturer_name ?? ''),
                                productLangTable: $productLangTable,
                                categoryProductTable: $categoryProductTable,
                            );

                            $this->typeSenseClient->upsertProductDoc($tenantId, $document);
                            $upserted++;
                            $sourceActiveIds[] = (string) $productId;
                        } catch (Throwable) {
                            $failed++;
                        }
                    }

                    if ($onProgress !== null) {
                        $onProgress([
                            'processed' => $processed,
                            'upserted' => $upserted,
                            'failed' => $failed,
                        ]);
                    }
                });

            $sourceActiveIds = array_values(array_unique($sourceActiveIds));
            $sourceInactiveIds = array_values(array_unique($sourceInactiveIds));
            $staleIds = $runMode === 'full'
                ? array_values(array_diff($existingDocumentIds, $sourceActiveIds))
                : [];
            $inactiveIds = $runMode === 'full'
                ? array_values(array_intersect($existingDocumentIds, $sourceInactiveIds))
                : $sourceInactiveIds;
            $idsToDelete = array_values(array_unique(array_merge($staleIds, $inactiveIds)));

            foreach ($idsToDelete as $documentId) {
                $this->typeSenseClient->deleteProductDoc($tenantId, $documentId);
            }

            if ($hasDateUpdColumn && $maxSeenDateUpd !== null) {
                Cache::forever($watermarkKey, $maxSeenDateUpd);
            }

            return [
                'mode' => $runMode,
                'processed' => $processed,
                'upserted' => $upserted,
                'failed' => $failed,
                'deleted' => count($idsToDelete),
                'stale_deleted' => count($staleIds),
                'inactive_deleted' => count($inactiveIds),
            ];
        } finally {
            if ($previousTenant instanceof Tenant) {
                $this->tenantContext->setTenant($previousTenant);
            } else {
                $this->tenantContext->clear();
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function buildProductDocument(
        int $tenantId,
        int $productId,
        string $reference,
        string $manufacturerName,
        string $productLangTable,
        string $categoryProductTable,
    ): array {
        $pricing = $this->pricingService->computeForProduct($productId);

        $name = DB::connection('tenant_ps')
            ->table($productLangTable)
            ->where('id_product', $productId)
            ->orderBy('id_lang')
            ->value('name');

        $categoryIds = DB::connection('tenant_ps')
            ->table($categoryProductTable)
            ->where('id_product', $productId)
            ->pluck('id_category')
            ->map(static fn (mixed $value): string => (string) $value)
            ->values()
            ->all();

        return [
            'id' => (string) $productId,
            'name' => is_scalar($name) ? (string) $name : '',
            'reference' => $reference,
            'active' => true,
            'manufacturer_name' => $manufacturerName,
            'category_ids' => $categoryIds,
            'original_price_tax_excl' => (float) $pricing['original_price_tax_excl'],
            'current_price_tax_excl' => (float) $pricing['current_price_tax_excl'],
            'original_price_tax_incl' => (float) $pricing['original_price_tax_incl'],
            'current_price_tax_incl' => (float) $pricing['current_price_tax_incl'],
            'discount_amount_tax_excl' => (float) $pricing['discount_amount_tax_excl'],
            'discount_percent' => (float) $pricing['discount_percent'],
            'product_url' => '/products/'.$productId,
            'image_url' => '',
            'updated_at' => now()->timestamp,
        ];
    }

    private function watermarkCacheKey(int $tenantId): string
    {
        return "typesense:tenant:{$tenantId}:last_date_upd_sync";
    }
}
