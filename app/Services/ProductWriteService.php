<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use Throwable;

class ProductWriteService
{
    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
        private PricingService $pricingService,
        private TypeSenseClient $typeSenseClient,
    ) {}

    public function updateProductStock(int $productId, int $qty): void
    {
        if ($qty < 0) {
            throw new RuntimeException('Stock quantity must be zero or greater.');
        }

        $tenantId = $this->resolveTenantId();
        $stockTable = $this->tenantPrestaShopConnection->table('stock_available');
        $beforeQty = null;

        DB::connection('tenant_ps')->transaction(function () use ($productId, $qty, $stockTable, $tenantId, &$beforeQty): void {
            $this->assertProductExists($productId);

            $beforeQty = DB::connection('tenant_ps')
                ->table($stockTable)
                ->where('id_product', $productId)
                ->where('id_product_attribute', 0)
                ->sum('quantity');

            $updatedRows = DB::connection('tenant_ps')
                ->table($stockTable)
                ->where('id_product', $productId)
                ->where('id_product_attribute', 0)
                ->update(['quantity' => $qty]);

            if ($updatedRows < 1) {
                throw new RuntimeException('Product stock row not found in PrestaShop database.');
            }

            DB::connection('tenant_ps')->afterCommit(function () use ($tenantId, $productId, $beforeQty, $qty): void {
                $this->recordAuditLog(
                    tenantId: $tenantId,
                    action: 'product.stock.updated',
                    entityId: (string) $productId,
                    payload: [
                        'before' => ['stock_qty' => (int) $beforeQty],
                        'after' => ['stock_qty' => $qty],
                    ],
                );

                $this->upsertProductDoc($tenantId, $productId);
            });
        });
    }

    public function updateProductBasePrice(int $productId, float $priceExcl): void
    {
        if ($priceExcl < 0) {
            throw new RuntimeException('Base price must be zero or greater.');
        }

        $tenantId = $this->resolveTenantId();
        $productTable = $this->tenantPrestaShopConnection->table('product');
        $beforePrice = null;
        $resolvedPrice = round($priceExcl, 6);

        DB::connection('tenant_ps')->transaction(function () use ($productId, $resolvedPrice, $tenantId, $productTable, &$beforePrice): void {
            $beforePrice = DB::connection('tenant_ps')
                ->table($productTable)
                ->where('id_product', $productId)
                ->value('price');

            if ($beforePrice === null) {
                throw new RuntimeException('Product not found in PrestaShop database.');
            }

            DB::connection('tenant_ps')
                ->table($productTable)
                ->where('id_product', $productId)
                ->update(['price' => $resolvedPrice]);

            DB::connection('tenant_ps')->afterCommit(function () use ($tenantId, $productId, $beforePrice, $resolvedPrice): void {
                $this->recordAuditLog(
                    tenantId: $tenantId,
                    action: 'product.base_price.updated',
                    entityId: (string) $productId,
                    payload: [
                        'before' => ['base_price_tax_excl' => round((float) $beforePrice, 6)],
                        'after' => ['base_price_tax_excl' => $resolvedPrice],
                    ],
                );

                $this->upsertProductDoc($tenantId, $productId);
            });
        });
    }

    /**
     * @param  array{price:mixed,reduction:mixed,reduction_type:mixed,from:mixed,to:mixed}  $payload
     */
    public function createProductSpecificPrice(int $productId, array $payload): void
    {
        $tenantId = $this->resolveTenantId();
        $specificPriceTable = $this->tenantPrestaShopConnection->table('specific_price');
        $resolvedPayload = $this->resolveSpecificPricePayload($payload);
        $specificPriceId = null;

        DB::connection('tenant_ps')->transaction(function () use ($tenantId, $productId, $specificPriceTable, $resolvedPayload, &$specificPriceId): void {
            $this->assertProductExists($productId);

            $specificPriceId = $this->resolveNextSpecificPriceId($specificPriceTable);

            DB::connection('tenant_ps')
                ->table($specificPriceTable)
                ->insert([
                    'id_specific_price' => $specificPriceId,
                    'id_product' => $productId,
                    'id_product_attribute' => 0,
                    'price' => $resolvedPayload['price'],
                    'reduction' => $resolvedPayload['reduction'],
                    'reduction_type' => $resolvedPayload['reduction_type'],
                    'from' => $resolvedPayload['from'],
                    'to' => $resolvedPayload['to'],
                ]);

            DB::connection('tenant_ps')->afterCommit(function () use ($tenantId, $productId, $specificPriceId, $resolvedPayload): void {
                $this->recordAuditLog(
                    tenantId: $tenantId,
                    action: 'product.specific_price.created',
                    entityId: (string) $productId,
                    payload: [
                        'after' => [
                            'id_specific_price' => $specificPriceId,
                            ...$resolvedPayload,
                        ],
                    ],
                );

                $this->upsertProductDoc($tenantId, $productId);
            });
        });
    }

    /**
     * @param  array{price:mixed,reduction:mixed,reduction_type:mixed,from:mixed,to:mixed}  $payload
     */
    public function updateProductSpecificPrice(int $productId, int $specificPriceId, array $payload): void
    {
        $tenantId = $this->resolveTenantId();
        $specificPriceTable = $this->tenantPrestaShopConnection->table('specific_price');
        $resolvedPayload = $this->resolveSpecificPricePayload($payload);
        $before = null;

        DB::connection('tenant_ps')->transaction(function () use ($tenantId, $productId, $specificPriceId, $specificPriceTable, $resolvedPayload, &$before): void {
            $this->assertProductExists($productId);
            $before = $this->findDateValidProductLevelSpecificPrice($specificPriceTable, $productId, $specificPriceId);

            DB::connection('tenant_ps')
                ->table($specificPriceTable)
                ->where('id_specific_price', $specificPriceId)
                ->update([
                    'price' => $resolvedPayload['price'],
                    'reduction' => $resolvedPayload['reduction'],
                    'reduction_type' => $resolvedPayload['reduction_type'],
                    'from' => $resolvedPayload['from'],
                    'to' => $resolvedPayload['to'],
                ]);

            DB::connection('tenant_ps')->afterCommit(function () use ($tenantId, $productId, $specificPriceId, $before, $resolvedPayload): void {
                $this->recordAuditLog(
                    tenantId: $tenantId,
                    action: 'product.specific_price.updated',
                    entityId: (string) $productId,
                    payload: [
                        'before' => [
                            'id_specific_price' => (int) data_get($before, 'id_specific_price'),
                            'price' => (float) data_get($before, 'price'),
                            'reduction' => (float) data_get($before, 'reduction'),
                            'reduction_type' => (string) data_get($before, 'reduction_type'),
                            'from' => (string) data_get($before, 'from'),
                            'to' => (string) data_get($before, 'to'),
                        ],
                        'after' => [
                            'id_specific_price' => $specificPriceId,
                            ...$resolvedPayload,
                        ],
                    ],
                );

                $this->upsertProductDoc($tenantId, $productId);
            });
        });
    }

    public function deleteProductSpecificPrice(int $productId, int $specificPriceId): void
    {
        $tenantId = $this->resolveTenantId();
        $specificPriceTable = $this->tenantPrestaShopConnection->table('specific_price');
        $before = null;

        DB::connection('tenant_ps')->transaction(function () use ($tenantId, $productId, $specificPriceId, $specificPriceTable, &$before): void {
            $this->assertProductExists($productId);
            $before = $this->findDateValidProductLevelSpecificPrice($specificPriceTable, $productId, $specificPriceId);

            DB::connection('tenant_ps')
                ->table($specificPriceTable)
                ->where('id_specific_price', $specificPriceId)
                ->delete();

            DB::connection('tenant_ps')->afterCommit(function () use ($tenantId, $productId, $before): void {
                $this->recordAuditLog(
                    tenantId: $tenantId,
                    action: 'product.specific_price.deleted',
                    entityId: (string) $productId,
                    payload: [
                        'before' => [
                            'id_specific_price' => (int) data_get($before, 'id_specific_price'),
                            'price' => (float) data_get($before, 'price'),
                            'reduction' => (float) data_get($before, 'reduction'),
                            'reduction_type' => (string) data_get($before, 'reduction_type'),
                            'from' => (string) data_get($before, 'from'),
                            'to' => (string) data_get($before, 'to'),
                        ],
                    ],
                );

                $this->upsertProductDoc($tenantId, $productId);
            });
        });
    }

    private function upsertProductDoc(int $tenantId, int $productId): void
    {
        $pricing = $this->pricingService->computeForProduct($productId);
        $productTable = $this->tenantPrestaShopConnection->table('product');
        $productLangTable = $this->tenantPrestaShopConnection->table('product_lang');
        $manufacturerTable = $this->tenantPrestaShopConnection->table('manufacturer');
        $categoryProductTable = $this->tenantPrestaShopConnection->table('category_product');

        /** @var object{reference:?string,active:int|string|bool,name:?string,manufacturer_name:?string}|null $product */
        $product = DB::connection('tenant_ps')
            ->table($productTable.' as p')
            ->leftJoin($manufacturerTable.' as m', 'm.id_manufacturer', '=', 'p.id_manufacturer')
            ->leftJoin($productLangTable.' as pl', 'pl.id_product', '=', 'p.id_product')
            ->where('p.id_product', $productId)
            ->orderBy('pl.id_lang')
            ->first([
                'p.reference',
                'p.active',
                'pl.name',
                DB::raw("COALESCE(m.name, '') as manufacturer_name"),
            ]);

        if ($product === null) {
            throw new RuntimeException('Product not found in PrestaShop database.');
        }

        /** @var list<string> $categoryIds */
        $categoryIds = DB::connection('tenant_ps')
            ->table($categoryProductTable)
            ->where('id_product', $productId)
            ->pluck('id_category')
            ->map(static fn (mixed $value): string => (string) $value)
            ->values()
            ->all();

        $this->typeSenseClient->ensureCollectionExists($tenantId);
        $this->typeSenseClient->upsertProductDoc($tenantId, [
            'id' => (string) $productId,
            'name' => (string) ($product->name ?? ''),
            'reference' => (string) ($product->reference ?? ''),
            'active' => (bool) $product->active,
            'manufacturer_name' => (string) ($product->manufacturer_name ?? ''),
            'category_ids' => $categoryIds,
            'original_price_tax_excl' => $pricing['original_price_tax_excl'],
            'current_price_tax_excl' => $pricing['current_price_tax_excl'],
            'original_price_tax_incl' => $pricing['original_price_tax_incl'],
            'current_price_tax_incl' => $pricing['current_price_tax_incl'],
            'discount_amount_tax_excl' => $pricing['discount_amount_tax_excl'],
            'discount_percent' => $pricing['discount_percent'],
            'product_url' => '/products/'.$productId,
            'image_url' => '',
            'updated_at' => now()->timestamp,
        ]);
    }

    private function assertProductExists(int $productId): void
    {
        $productTable = $this->tenantPrestaShopConnection->table('product');

        $exists = DB::connection('tenant_ps')
            ->table($productTable)
            ->where('id_product', $productId)
            ->exists();

        if (! $exists) {
            throw new RuntimeException('Product not found in PrestaShop database.');
        }
    }

    /**
     * @param  array{price:mixed,reduction:mixed,reduction_type:mixed,from:mixed,to:mixed}  $payload
     * @return array{price:float,reduction:float,reduction_type:string,from:string,to:string}
     */
    private function resolveSpecificPricePayload(array $payload): array
    {
        $price = round((float) ($payload['price'] ?? -1), 6);
        $reduction = round((float) ($payload['reduction'] ?? 0), 6);
        $reductionType = (string) ($payload['reduction_type'] ?? '');

        try {
            $from = Carbon::parse((string) ($payload['from'] ?? ''));
            $to = Carbon::parse((string) ($payload['to'] ?? ''));
        } catch (Throwable) {
            throw new RuntimeException(__('saas.resources.products.relation_managers.specific_prices.errors.invalid_date_range'));
        }

        $now = Carbon::now();

        if ($price < -1) {
            throw new RuntimeException(__('saas.resources.products.relation_managers.specific_prices.errors.invalid_price'));
        }

        if ($reduction < 0) {
            throw new RuntimeException(__('saas.resources.products.relation_managers.specific_prices.errors.invalid_reduction'));
        }

        if (! in_array($reductionType, ['amount', 'percentage'], true)) {
            throw new RuntimeException(__('saas.resources.products.relation_managers.specific_prices.errors.invalid_reduction_type'));
        }

        if ($reductionType === 'percentage' && $reduction > 1) {
            throw new RuntimeException(__('saas.resources.products.relation_managers.specific_prices.errors.invalid_percentage_reduction'));
        }

        if ($from->greaterThan($to)) {
            throw new RuntimeException(__('saas.resources.products.relation_managers.specific_prices.errors.invalid_date_range'));
        }

        if ($from->greaterThan($now) || $to->lessThan($now)) {
            throw new RuntimeException(__('saas.resources.products.relation_managers.specific_prices.errors.not_date_valid'));
        }

        return [
            'price' => $price,
            'reduction' => $reduction,
            'reduction_type' => $reductionType,
            'from' => $from->format('Y-m-d H:i:s'),
            'to' => $to->format('Y-m-d H:i:s'),
        ];
    }

    private function resolveNextSpecificPriceId(string $specificPriceTable): int
    {
        $lastId = DB::connection('tenant_ps')
            ->table($specificPriceTable)
            ->max('id_specific_price');

        $resolvedLastId = is_numeric($lastId) ? (int) $lastId : 0;

        return $resolvedLastId + 1;
    }

    /**
     * @return object{id_specific_price:int|string,price:float|int|string,reduction:float|int|string,reduction_type:string,from:string,to:string}
     */
    private function findDateValidProductLevelSpecificPrice(string $specificPriceTable, int $productId, int $specificPriceId): object
    {
        $now = now()->format('Y-m-d H:i:s');

        /** @var object{id_specific_price:int|string,price:float|int|string,reduction:float|int|string,reduction_type:string,from:string,to:string}|null $specificPrice */
        $specificPrice = DB::connection('tenant_ps')
            ->table($specificPriceTable)
            ->where('id_specific_price', $specificPriceId)
            ->where('id_product', $productId)
            ->where('id_product_attribute', 0)
            ->where(function ($query) use ($now): void {
                $query->where('from', '0000-00-00 00:00:00')
                    ->orWhere('from', '<=', $now);
            })
            ->where(function ($query) use ($now): void {
                $query->where('to', '0000-00-00 00:00:00')
                    ->orWhere('to', '>=', $now);
            })
            ->first(['id_specific_price', 'price', 'reduction', 'reduction_type', 'from', 'to']);

        if ($specificPrice === null) {
            throw new RuntimeException(__('saas.resources.products.relation_managers.specific_prices.errors.not_found_or_out_of_scope'));
        }

        return $specificPrice;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function recordAuditLog(int $tenantId, string $action, string $entityId, array $payload): void
    {
        AuditLog::query()->create([
            'tenant_id' => $tenantId,
            'actor_user_id' => $this->resolveActorUserId(),
            'actor_tenant_user_id' => $this->resolveActorTenantUserId(),
            'action' => $action,
            'entity_type' => 'ps_product',
            'entity_id' => $entityId,
            'payload' => $payload,
        ]);
    }

    private function resolveTenantId(): int
    {
        $tenantId = $this->tenantContext->tenantId() ?? request()->attributes->get('tenant_id');

        if (is_string($tenantId) && ctype_digit($tenantId)) {
            $tenantId = (int) $tenantId;
        }

        if (! is_int($tenantId) || $tenantId < 1) {
            throw new RuntimeException('Tenant context is missing.');
        }

        return $tenantId;
    }

    private function resolveActorUserId(): ?int
    {
        $user = Auth::guard('web')->user();

        if (! $user instanceof User) {
            return null;
        }

        return $user->id;
    }

    private function resolveActorTenantUserId(): ?int
    {
        $tenantUser = Auth::guard('tenant')->user();

        if (! $tenantUser instanceof User) {
            return null;
        }

        return $tenantUser->id;
    }
}
