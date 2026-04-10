<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TypesenseProductDocumentBuilder
{
    /**
     * @var array<string, bool>
     */
    private array $columnCache = [];

    public function __construct(
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
        private PricingService $pricingService,
        private TenantPrestaShopFeatureService $featureService,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function build(int $tenantId, int $productId): array
    {
        $productTable = $this->tenantPrestaShopConnection->table('product');
        $productLangTable = $this->tenantPrestaShopConnection->table('product_lang');
        $manufacturerTable = $this->tenantPrestaShopConnection->table('manufacturer');
        $categoryProductTable = $this->tenantPrestaShopConnection->table('category_product');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('category_lang');
        $stockTable = $this->tenantPrestaShopConnection->table('stock_available');
        $hasDefaultCategoryColumn = $this->hasColumn($productTable, 'id_category_default');
        $hasDescriptionShortColumn = $this->hasColumn($productLangTable, 'description_short');
        $hasDescriptionColumn = $this->hasColumn($productLangTable, 'description');
        $hasLinkRewriteColumn = $this->hasColumn($productLangTable, 'link_rewrite');

        /** @var object{reference:?string,active:mixed,manufacturer_name:?string,id_category_default:mixed,ean13?:?string,date_upd?:?string}|null $product */
        $product = DB::connection('tenant_ps')
            ->table($productTable.' as p')
            ->leftJoin($manufacturerTable.' as m', 'm.id_manufacturer', '=', 'p.id_manufacturer')
            ->where('p.id_product', $productId)
            ->first([
                'p.reference',
                'p.active',
                ...($hasDefaultCategoryColumn ? ['p.id_category_default'] : []),
                ...($this->hasColumn($productTable, 'ean13') ? ['p.ean13'] : []),
                ...($this->hasColumn($productTable, 'date_upd') ? ['p.date_upd'] : []),
                DB::raw("COALESCE(m.name, '') as manufacturer_name"),
            ]);

        /** @var object{id_lang:mixed,name:?string,description_short:?string,description:?string,link_rewrite:?string}|null $productLang */
        $productLang = DB::connection('tenant_ps')
            ->table($productLangTable)
            ->where('id_product', $productId)
            ->orderBy('id_lang')
            ->first([
                'id_lang',
                'name',
                ...($hasDescriptionShortColumn ? ['description_short'] : []),
                ...($hasDescriptionColumn ? ['description'] : []),
                ...($hasLinkRewriteColumn ? ['link_rewrite'] : []),
            ]);

        $langId = max(1, (int) data_get($productLang, 'id_lang', 1));
        $brand = trim((string) data_get($product, 'manufacturer_name', ''));
        $reference = trim((string) data_get($product, 'reference', ''));
        $name = trim((string) data_get($productLang, 'name', ''));

        /** @var list<string> $categoryIds */
        $categoryIds = DB::connection('tenant_ps')
            ->table($categoryProductTable)
            ->where('id_product', $productId)
            ->orderBy('id_category')
            ->pluck('id_category')
            ->map(static fn (mixed $value): string => (string) $value)
            ->values()
            ->all();

        /** @var array<int, string> $categoryNamesById */
        $categoryNamesById = [];

        if ($this->hasTable($categoryLangTable) && $categoryIds !== []) {
            $categoryNamesById = DB::connection('tenant_ps')
                ->table($categoryLangTable)
                ->where('id_lang', $langId)
                ->whereIn('id_category', array_map('intval', $categoryIds))
                ->pluck('name', 'id_category')
                ->mapWithKeys(static fn (mixed $label, mixed $id): array => [(int) $id => trim((string) $label)])
                ->all();
        }

        /** @var list<string> $categoryNames */
        $categoryNames = collect($categoryIds)
            ->map(static fn (string $categoryId): int => (int) $categoryId)
            ->map(static fn (int $categoryId) => $categoryNamesById[$categoryId] ?? null)
            ->filter(static fn (mixed $value): bool => is_string($value) && $value !== '')
            ->values()
            ->all();

        $defaultCategoryId = (int) data_get($product, 'id_category_default', 0);
        $primaryCategory = $categoryNamesById[$defaultCategoryId] ?? ($categoryNames[0] ?? '');

        /** @var list<string> $categories */
        $categories = collect([$brand, ...$categoryNames])
            ->map(static fn (string $value): string => trim($value))
            ->filter(static fn (string $value): bool => $value !== '')
            ->unique()
            ->values()
            ->all();

        $quantity = $this->hasTable($stockTable)
            ? (int) DB::connection('tenant_ps')
                ->table($stockTable)
                ->where('id_product', $productId)
                ->where('id_product_attribute', 0)
                ->sum('quantity')
            : 0;

        $pricing = $this->pricingService->computeForProduct($productId);
        $inhoud = $this->featureService->getProductInhoud($productId, $langId);
        $slug = trim((string) data_get($productLang, 'link_rewrite', ''));
        $fallbackLink = '/products/'.$productId;
        $link = $slug !== '' ? '/'.$slug : $fallbackLink;

        return [
            'id' => (string) $productId,
            'doc_id' => $tenantId.'-'.$productId,
            'name' => $name,
            'reference' => $reference,
            'ean13' => trim((string) data_get($product, 'ean13', '')),
            'active' => (bool) data_get($product, 'active', false),
            'manufacturer_name' => $brand,
            'brand' => $brand,
            'category_ids' => $categoryIds,
            'categories' => $categories,
            'category' => $primaryCategory,
            'description_short' => (string) data_get($productLang, 'description_short', ''),
            'description' => (string) data_get($productLang, 'description', ''),
            'contents' => $inhoud ?? '',
            'quantity' => $quantity,
            'price' => (float) $pricing['current_price_tax_excl'],
            'price_original' => (float) $pricing['original_price_tax_excl'],
            'original_price_tax_excl' => (float) $pricing['original_price_tax_excl'],
            'current_price_tax_excl' => (float) $pricing['current_price_tax_excl'],
            'original_price_tax_incl' => (float) $pricing['original_price_tax_incl'],
            'current_price_tax_incl' => (float) $pricing['current_price_tax_incl'],
            'discount_amount_tax_excl' => (float) $pricing['discount_amount_tax_excl'],
            'discount_percent' => (float) $pricing['discount_percent'],
            'link' => $link,
            'image' => '',
            'product_url' => $fallbackLink,
            'image_url' => '',
            'sync_run_id' => '',
            'updated_at_iso' => (string) (data_get($product, 'date_upd') ?: now()->format('Y-m-d H:i:s')),
            'updated_at' => now()->timestamp,
        ];
    }

    private function hasColumn(string $table, string $column): bool
    {
        $cacheKey = $table.'.'.$column;

        if (array_key_exists($cacheKey, $this->columnCache)) {
            return $this->columnCache[$cacheKey];
        }

        return $this->columnCache[$cacheKey] = Schema::connection('tenant_ps')->hasColumn($table, $column);
    }

    private function hasTable(string $table): bool
    {
        return Schema::connection('tenant_ps')->hasTable($table);
    }
}
