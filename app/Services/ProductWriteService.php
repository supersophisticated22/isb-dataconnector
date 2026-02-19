<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;

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
     * @param  array<string, mixed>  $payload
     */
    private function recordAuditLog(int $tenantId, string $action, string $entityId, array $payload): void
    {
        AuditLog::query()->create([
            'tenant_id' => $tenantId,
            'actor_user_id' => $this->resolveActorUserId(),
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
        $user = Auth::user();

        if (! $user instanceof User) {
            return null;
        }

        return $user->id;
    }
}
