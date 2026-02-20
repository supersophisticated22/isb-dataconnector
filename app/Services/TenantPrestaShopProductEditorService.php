<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use RuntimeException;

class TenantPrestaShopProductEditorService
{
    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
        private TenantPrestaShopCategoryService $categoryService,
        private TenantPrestaShopFeatureService $featureService,
    ) {}

    /**
     * @return array{
     *     name:string,
     *     description_short:?string,
     *     description:?string,
     *     meta_title:?string,
     *     meta_description:?string,
     *     meta_keywords:?string,
     *     link_rewrite:string,
     *     weight:?float,
     *     defaultCategoryId:?int,
     *     categoryIds:list<int>,
     *     inhoud:?string,
     *     inhoudFeatureId:?int
     * }
     */
    public function getProductEditData(int $productId, int $langId): array
    {
        $this->resolveTenantId();

        if ($productId < 1 || $langId < 1) {
            throw new RuntimeException('Product and language are required.');
        }

        $productTable = $this->tenantPrestaShopConnection->table('product');
        $productLangTable = $this->tenantPrestaShopConnection->table('product_lang');

        $productColumns = ['id_product'];

        if ($this->hasColumn($productTable, 'weight')) {
            $productColumns[] = 'weight';
        }

        $productRow = DB::connection('tenant_ps')
            ->table($productTable)
            ->where('id_product', $productId)
            ->first($productColumns);

        if ($productRow === null) {
            throw new RuntimeException('Product not found in PrestaShop database.');
        }

        $langRow = DB::connection('tenant_ps')
            ->table($productLangTable)
            ->where('id_product', $productId)
            ->where('id_lang', $langId)
            ->first([
                'name',
                'description_short',
                'description',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'link_rewrite',
            ]);

        $categories = $this->categoryService->getProductCategories($productId);

        return [
            'name' => trim((string) data_get($langRow, 'name', '')),
            'description_short' => $this->nullableString(data_get($langRow, 'description_short')),
            'description' => $this->nullableString(data_get($langRow, 'description')),
            'meta_title' => $this->nullableString(data_get($langRow, 'meta_title')),
            'meta_description' => $this->nullableString(data_get($langRow, 'meta_description')),
            'meta_keywords' => $this->nullableString(data_get($langRow, 'meta_keywords')),
            'link_rewrite' => trim((string) data_get($langRow, 'link_rewrite', '')),
            'weight' => data_get($productRow, 'weight') !== null ? (float) data_get($productRow, 'weight') : null,
            'defaultCategoryId' => $categories['defaultCategoryId'],
            'categoryIds' => $categories['categoryIds'],
            'inhoud' => $this->featureService->getProductInhoud($productId, $langId),
            'inhoudFeatureId' => $this->featureService->resolveInhoudFeatureId($langId),
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateProduct(int $productId, int $langId, array $payload): void
    {
        $this->resolveTenantId();

        if ($productId < 1 || $langId < 1) {
            throw new RuntimeException('Product and language are required.');
        }

        $resolvedPayload = $this->resolvePayload($payload);

        DB::connection('tenant_ps')->transaction(function () use ($productId, $langId, $resolvedPayload): void {
            $this->assertProductExists($productId);

            $this->updateProductAndShopAttributes(
                productId: $productId,
                weight: $resolvedPayload['weight'],
                defaultCategoryId: $resolvedPayload['defaultCategoryId'],
            );

            $this->upsertProductLangRow(
                productId: $productId,
                langId: $langId,
                payload: [
                    'name' => $resolvedPayload['name'],
                    'description_short' => $resolvedPayload['description_short'],
                    'description' => $resolvedPayload['description'],
                    'meta_title' => $resolvedPayload['meta_title'],
                    'meta_description' => $resolvedPayload['meta_description'],
                    'meta_keywords' => $resolvedPayload['meta_keywords'],
                    'link_rewrite' => $resolvedPayload['link_rewrite'],
                ],
            );

            $this->syncProductCategories(
                productId: $productId,
                defaultCategoryId: $resolvedPayload['defaultCategoryId'],
                categoryIds: $resolvedPayload['categoryIds'],
            );

            $this->featureService->upsertProductInhoud(
                productId: $productId,
                langId: $langId,
                value: $resolvedPayload['inhoud'] ?? '',
            );
        });
    }

    private function resolveTenantId(): int
    {
        $tenantId = $this->tenantContext->tenantId();

        if (! is_int($tenantId) || $tenantId < 1) {
            throw new RuntimeException('Tenant context is missing.');
        }

        return $tenantId;
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
     * @return array{
     *     name:string,
     *     description_short:?string,
     *     description:?string,
     *     meta_title:?string,
     *     meta_description:?string,
     *     meta_keywords:?string,
     *     link_rewrite:string,
     *     weight:?float,
     *     defaultCategoryId:int,
     *     categoryIds:list<int>,
     *     inhoud:?string
     * }
     */
    private function resolvePayload(array $payload): array
    {
        $name = trim((string) ($payload['name'] ?? ''));

        if ($name === '') {
            throw new RuntimeException('Product name is required.');
        }

        if (Str::length($name) > 255) {
            throw new RuntimeException('Product name may not be greater than 255 characters.');
        }

        $linkRewrite = $this->sanitizeSlug((string) ($payload['link_rewrite'] ?? ''));

        if ($linkRewrite === '') {
            throw new RuntimeException('Product slug is required.');
        }

        $metaTitle = $this->nullableString($payload['meta_title'] ?? null);

        if ($metaTitle !== null && Str::length($metaTitle) > 255) {
            throw new RuntimeException('Meta title may not be greater than 255 characters.');
        }

        $metaDescription = $this->nullableString($payload['meta_description'] ?? null);

        if ($metaDescription !== null && Str::length($metaDescription) > 512) {
            throw new RuntimeException('Meta description may not be greater than 512 characters.');
        }

        $inhoud = $this->nullableString($payload['inhoud'] ?? null);

        if ($inhoud !== null && Str::length($inhoud) > 255) {
            throw new RuntimeException('Inhoud may not be greater than 255 characters.');
        }

        $weight = $payload['weight'] ?? null;

        if ($weight !== null && $weight !== '' && (! is_numeric($weight) || (float) $weight < 0)) {
            throw new RuntimeException('Weight must be a number equal to or greater than zero.');
        }

        $defaultCategoryId = (int) ($payload['defaultCategoryId'] ?? 0);

        if ($defaultCategoryId < 1) {
            throw new RuntimeException('Default category is required.');
        }

        $categoryIds = collect($payload['categoryIds'] ?? [])
            ->map(static fn (mixed $id): int => (int) $id)
            ->filter(static fn (int $id): bool => $id > 0)
            ->unique()
            ->values()
            ->all();

        if (! in_array($defaultCategoryId, $categoryIds, true)) {
            array_unshift($categoryIds, $defaultCategoryId);
        }

        return [
            'name' => $name,
            'description_short' => $this->nullableString($payload['description_short'] ?? null),
            'description' => $this->nullableString($payload['description'] ?? null),
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'meta_keywords' => $this->nullableString($payload['meta_keywords'] ?? null),
            'link_rewrite' => Str::substr($linkRewrite, 0, 128),
            'weight' => ($weight === null || $weight === '') ? null : round((float) $weight, 6),
            'defaultCategoryId' => $defaultCategoryId,
            'categoryIds' => $categoryIds,
            'inhoud' => $inhoud,
        ];
    }

    private function sanitizeSlug(string $value): string
    {
        return (string) Str::of($value)
            ->trim()
            ->lower()
            ->ascii()
            ->replaceMatches('/[^a-z0-9]+/', '-')
            ->trim('-')
            ->value();
    }

    private function nullableString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $resolved = trim((string) $value);

        return $resolved === '' ? null : $resolved;
    }

    private function updateProductAndShopAttributes(int $productId, ?float $weight, int $defaultCategoryId): void
    {
        $productTable = $this->tenantPrestaShopConnection->table('product');
        $productPayload = [
            'id_category_default' => $defaultCategoryId,
        ];

        if ($this->hasColumn($productTable, 'weight')) {
            $productPayload['weight'] = $weight ?? 0;
        }

        DB::connection('tenant_ps')
            ->table($productTable)
            ->where('id_product', $productId)
            ->update($productPayload);

        $productShopTable = $this->tenantPrestaShopConnection->table('product_shop');

        if (! $this->hasTable($productShopTable)) {
            return;
        }

        $productShopPayload = [];

        if ($this->hasColumn($productShopTable, 'id_category_default')) {
            $productShopPayload['id_category_default'] = $defaultCategoryId;
        }

        if ($this->hasColumn($productShopTable, 'weight')) {
            $productShopPayload['weight'] = $weight ?? 0;
        }

        if ($productShopPayload === []) {
            return;
        }

        DB::connection('tenant_ps')
            ->table($productShopTable)
            ->where('id_product', $productId)
            ->update($productShopPayload);
    }

    /**
     * @param  array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string}  $payload
     */
    private function upsertProductLangRow(int $productId, int $langId, array $payload): void
    {
        $productLangTable = $this->tenantPrestaShopConnection->table('product_lang');

        $exists = DB::connection('tenant_ps')
            ->table($productLangTable)
            ->where('id_product', $productId)
            ->where('id_lang', $langId)
            ->exists();

        if ($exists) {
            DB::connection('tenant_ps')
                ->table($productLangTable)
                ->where('id_product', $productId)
                ->where('id_lang', $langId)
                ->update($payload);

            return;
        }

        $insertPayload = $this->resolveProductLangInsertPayload(
            productLangTable: $productLangTable,
            productId: $productId,
            langId: $langId,
            payload: $payload,
        );

        DB::connection('tenant_ps')
            ->table($productLangTable)
            ->insert($insertPayload);
    }

    /**
     * @param  array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string}  $payload
     * @return array<string, mixed>
     */
    private function resolveProductLangInsertPayload(string $productLangTable, int $productId, int $langId, array $payload): array
    {
        $templateRow = DB::connection('tenant_ps')
            ->table($productLangTable)
            ->where('id_product', $productId)
            ->orderBy('id_lang')
            ->first();

        if ($templateRow === null) {
            $templateRow = DB::connection('tenant_ps')
                ->table($productLangTable)
                ->where('id_lang', $langId)
                ->orderBy('id_product')
                ->first();
        }

        if ($templateRow === null) {
            $templateRow = DB::connection('tenant_ps')
                ->table($productLangTable)
                ->orderBy('id_product')
                ->first();
        }

        /** @var array<string, mixed> $insertPayload */
        $insertPayload = is_object($templateRow) ? (array) $templateRow : [];
        $insertPayload['id_product'] = $productId;
        $insertPayload['id_lang'] = $langId;

        foreach ($payload as $column => $value) {
            $insertPayload[$column] = $value;
        }

        return $insertPayload;
    }

    /**
     * @param  list<int>  $categoryIds
     */
    private function syncProductCategories(int $productId, int $defaultCategoryId, array $categoryIds): void
    {
        $categoryProductTable = $this->tenantPrestaShopConnection->table('category_product');
        $supportsPosition = $this->hasColumn($categoryProductTable, 'position');

        $desiredCategoryIds = collect($categoryIds)
            ->map(static fn (int $id): int => (int) $id)
            ->filter(static fn (int $id): bool => $id > 0)
            ->unique()
            ->values()
            ->all();

        if (! in_array($defaultCategoryId, $desiredCategoryIds, true)) {
            array_unshift($desiredCategoryIds, $defaultCategoryId);
        }

        $existingRowsQuery = DB::connection('tenant_ps')
            ->table($categoryProductTable)
            ->where('id_product', $productId);

        if ($supportsPosition) {
            $existingRowsQuery->orderBy('position');
        } else {
            $existingRowsQuery->orderBy('id_category');
        }

        /** @var array<int, object{id_category:mixed,position:mixed}> $existingRows */
        $existingRows = $existingRowsQuery->get()->all();

        /** @var list<int> $existingCategoryIds */
        $existingCategoryIds = collect($existingRows)
            ->map(static fn (object $row): int => (int) data_get($row, 'id_category', 0))
            ->filter(static fn (int $id): bool => $id > 0)
            ->unique()
            ->values()
            ->all();

        $categoryIdsToDelete = array_values(array_diff($existingCategoryIds, $desiredCategoryIds));
        $categoryIdsToInsert = array_values(array_diff($desiredCategoryIds, $existingCategoryIds));

        if ($categoryIdsToDelete !== []) {
            DB::connection('tenant_ps')
                ->table($categoryProductTable)
                ->where('id_product', $productId)
                ->whereIn('id_category', $categoryIdsToDelete)
                ->delete();
        }

        if ($categoryIdsToInsert === []) {
            return;
        }

        $nextPosition = 0;

        if ($supportsPosition) {
            $nextPosition = ((int) DB::connection('tenant_ps')
                ->table($categoryProductTable)
                ->where('id_product', $productId)
                ->max('position')) + 1;
        }

        foreach ($categoryIdsToInsert as $categoryId) {
            $insertPayload = [
                'id_category' => $categoryId,
                'id_product' => $productId,
            ];

            if ($supportsPosition) {
                $insertPayload['position'] = $nextPosition;
                $nextPosition++;
            }

            DB::connection('tenant_ps')
                ->table($categoryProductTable)
                ->insert($insertPayload);
        }
    }

    private function hasTable(string $table): bool
    {
        return Schema::connection('tenant_ps')->hasTable($table);
    }

    private function hasColumn(string $table, string $column): bool
    {
        if (! $this->hasTable($table)) {
            return false;
        }

        return Schema::connection('tenant_ps')->hasColumn($table, $column);
    }
}
