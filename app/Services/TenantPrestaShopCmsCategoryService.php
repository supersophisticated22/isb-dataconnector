<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use RuntimeException;

class TenantPrestaShopCmsCategoryService
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

        $categoryTable = $this->tenantPrestaShopConnection->table('cms_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('cms_category_lang');

        /** @var array<int, object{id_cms_category:int|string,id_parent:int|string}> $categories */
        $categories = DB::connection('tenant_ps')
            ->table($categoryTable)
            ->orderBy('id_parent')
            ->orderBy('id_cms_category')
            ->get(['id_cms_category', 'id_parent'])
            ->all();

        /** @var array<int, string> $names */
        $names = DB::connection('tenant_ps')
            ->table($categoryLangTable)
            ->where('id_lang', $langId)
            ->pluck('name', 'id_cms_category')
            ->mapWithKeys(fn (mixed $name, mixed $id): array => [(int) $id => trim((string) $name)])
            ->filter(fn (string $name): bool => $name !== '')
            ->all();

        $parents = [];

        foreach ($categories as $category) {
            $categoryId = (int) data_get($category, 'id_cms_category', 0);

            if ($categoryId < 1) {
                continue;
            }

            $parents[$categoryId] = (int) data_get($category, 'id_parent', 0);
        }

        $options = [];

        foreach (array_keys($names) as $categoryId) {
            $label = $this->buildPathLabel($categoryId, $parents, $names);

            if ($label === '') {
                continue;
            }

            $options[$categoryId] = $label;
        }

        asort($options, SORT_NATURAL | SORT_FLAG_CASE);

        return $options;
    }

    public function getCategoryPathLabel(int $categoryId, int $langId): string
    {
        if ($categoryId < 1 || $langId < 1) {
            return '';
        }

        $options = $this->getCategoryOptions($langId);

        return $options[$categoryId] ?? '';
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
     * @param  array<int, int>  $parents
     * @param  array<int, string>  $names
     */
    private function buildPathLabel(int $categoryId, array $parents, array $names): string
    {
        $parts = [];
        $current = $categoryId;
        $visited = [];

        while ($current > 0) {
            if (isset($visited[$current])) {
                break;
            }

            $visited[$current] = true;

            $name = trim((string) ($names[$current] ?? ''));

            if ($name !== '') {
                $parts[] = $name;
            }

            $parentId = (int) ($parents[$current] ?? 0);

            if ($parentId <= 0 || $parentId === $current) {
                break;
            }

            $current = $parentId;
        }

        if ($parts === []) {
            return '';
        }

        return implode(' > ', array_reverse($parts));
    }
}
