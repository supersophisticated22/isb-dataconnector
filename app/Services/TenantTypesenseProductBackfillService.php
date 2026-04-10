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
        private TypeSenseClient $typeSenseClient,
        private TypesenseProductDocumentBuilder $typesenseProductDocumentBuilder,
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
                ->select([
                    'p.id_product',
                    'p.active',
                    ...($hasDateUpdColumn ? ['p.date_upd'] : []),
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
                    $onProgress
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
    private function buildProductDocument(int $tenantId, int $productId): array
    {
        return $this->typesenseProductDocumentBuilder->build($tenantId, $productId);
    }

    private function watermarkCacheKey(int $tenantId): string
    {
        return "typesense:tenant:{$tenantId}:last_date_upd_sync";
    }
}
