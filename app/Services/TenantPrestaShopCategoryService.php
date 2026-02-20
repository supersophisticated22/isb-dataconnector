<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

class TenantPrestaShopCategoryService
{
    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
    ) {}

    /**
     * @return array<int, string>
     */
    public function getCategoryOptions(int $langId): array
    {
        $this->resolveTenantId();

        if ($langId < 1) {
            return [];
        }

        $categoryTable = $this->tenantPrestaShopConnection->table('category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('category_lang');

        /** @var array<int, object{id_category:int|string,id_parent:int|string,name:?string}> $rows */
        $rows = DB::connection('tenant_ps')
            ->table($categoryTable.' as c')
            ->join($categoryLangTable.' as cl', function ($join) use ($langId): void {
                $join->on('cl.id_category', '=', 'c.id_category')
                    ->where('cl.id_lang', '=', $langId);
            })
            ->orderBy('c.id_parent')
            ->orderBy('cl.name')
            ->get([
                'c.id_category',
                'c.id_parent',
                'cl.name',
            ])
            ->all();

        /** @var array<int, array{id:int,parent:int,name:string}> $categories */
        $categories = [];

        foreach ($rows as $row) {
            $id = (int) $row->id_category;
            $name = trim((string) ($row->name ?? ''));

            if ($id < 1 || $name === '') {
                continue;
            }

            $categories[$id] = [
                'id' => $id,
                'parent' => (int) $row->id_parent,
                'name' => $name,
            ];
        }

        if ($categories === []) {
            return [];
        }

        $options = [];

        foreach (array_keys($categories) as $id) {
            $path = $this->resolveCategoryPath($id, $categories);
            $options[$id] = $path.' (#'.$id.')';
        }

        asort($options, SORT_NATURAL | SORT_FLAG_CASE);

        return $options;
    }

    /**
     * @return array{defaultCategoryId:int|null,categoryIds:list<int>}
     */
    public function getProductCategories(int $productId): array
    {
        $this->resolveTenantId();

        if ($productId < 1) {
            throw new RuntimeException('Product is required.');
        }

        $productTable = $this->tenantPrestaShopConnection->table('product');
        $categoryProductTable = $this->tenantPrestaShopConnection->table('category_product');
        $defaultCategoryId = DB::connection('tenant_ps')
            ->table($productTable)
            ->where('id_product', $productId)
            ->value('id_category_default');

        $query = DB::connection('tenant_ps')
            ->table($categoryProductTable)
            ->where('id_product', $productId);

        if ($this->tableHasColumn($categoryProductTable, 'position')) {
            $query->orderBy('position');
        } else {
            $query->orderBy('id_category');
        }

        /** @var list<int> $categoryIds */
        $categoryIds = $query
            ->pluck('id_category')
            ->map(static fn (mixed $id): int => (int) $id)
            ->filter(static fn (int $id): bool => $id > 0)
            ->unique()
            ->values()
            ->all();

        $resolvedDefaultCategoryId = (int) $defaultCategoryId;

        if ($resolvedDefaultCategoryId > 0 && ! in_array($resolvedDefaultCategoryId, $categoryIds, true)) {
            array_unshift($categoryIds, $resolvedDefaultCategoryId);
        }

        return [
            'defaultCategoryId' => $resolvedDefaultCategoryId > 0 ? $resolvedDefaultCategoryId : null,
            'categoryIds' => $categoryIds,
        ];
    }

    private function resolveTenantId(): int
    {
        $tenantId = $this->tenantContext->tenantId();

        if (! is_int($tenantId) || $tenantId < 1) {
            throw new RuntimeException('Tenant context is missing.');
        }

        return $tenantId;
    }

    /**
     * @param  array<int, array{id:int,parent:int,name:string}>  $categories
     */
    private function resolveCategoryPath(int $categoryId, array $categories): string
    {
        $parts = [];
        $visited = [];
        $cursor = $categoryId;

        while ($cursor > 0 && isset($categories[$cursor]) && ! isset($visited[$cursor])) {
            $visited[$cursor] = true;
            $parts[] = $categories[$cursor]['name'];
            $cursor = $categories[$cursor]['parent'];
        }

        $parts = array_reverse($parts);

        return implode(' > ', $parts);
    }

    private function tableHasColumn(string $table, string $column): bool
    {
        if (! Schema::connection('tenant_ps')->hasTable($table)) {
            return false;
        }

        return Schema::connection('tenant_ps')->hasColumn($table, $column);
    }
}
