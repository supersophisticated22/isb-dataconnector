<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

        $categoryData = $this->loadCategoryTreeData($langId);
        $categories = $categoryData['categories'];
        $names = $categoryData['names'];

        $parents = [];

        foreach ($categories as $category) {
            $categoryId = $category['id'];

            if ($categoryId < 1) {
                continue;
            }

            $parents[$categoryId] = $category['id_parent'];
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

    /**
     * @return LengthAwarePaginator<int, object>|array<int, array<string, mixed>>
     */
    public function listCategories(int $langId, int $perPage = 25): LengthAwarePaginator|array
    {
        $this->resolveTenantId();

        if ($langId < 1) {
            return [];
        }

        $categoryTable = $this->tenantPrestaShopConnection->table('cms_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('cms_category_lang');
        $resolvedPerPage = max(1, $perPage);

        return DB::connection('tenant_ps')
            ->table($categoryTable.' as c')
            ->leftJoin($categoryLangTable.' as cl', function ($join) use ($langId): void {
                $join
                    ->on('cl.id_cms_category', '=', 'c.id_cms_category')
                    ->where('cl.id_lang', '=', $langId);
            })
            ->leftJoin($categoryTable.' as p', 'p.id_cms_category', '=', 'c.id_parent')
            ->leftJoin($categoryLangTable.' as pl', function ($join) use ($langId): void {
                $join
                    ->on('pl.id_cms_category', '=', 'p.id_cms_category')
                    ->where('pl.id_lang', '=', $langId);
            })
            ->orderBy('c.level_depth')
            ->orderBy('c.position')
            ->orderBy('c.id_cms_category')
            ->select([
                'c.id_cms_category',
                'c.id_parent',
                'c.level_depth',
                'c.active',
                'c.position',
                'c.date_add',
                'c.date_upd',
                'cl.name',
                'pl.name as parent_name',
            ])
            ->paginate($resolvedPerPage);
    }

    /**
     * @return array{
     *     id_cms_category:int,
     *     id_parent:int,
     *     level_depth:int,
     *     active:bool,
     *     position:int,
     *     date_add:?string,
     *     date_upd:?string,
     *     name:string,
     *     parent_name:string
     * }
     */
    public function getCategory(int $categoryId, int $langId): array
    {
        $this->resolveTenantId();

        if ($categoryId < 1 || $langId < 1) {
            throw new RuntimeException('Category and language are required.');
        }

        $categoryTable = $this->tenantPrestaShopConnection->table('cms_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('cms_category_lang');

        /** @var object{id_cms_category:int|string,id_parent:int|string,level_depth:int|string,active:mixed,position:mixed,date_add:?string,date_upd:?string,name:?string,parent_name:?string}|null $row */
        $row = DB::connection('tenant_ps')
            ->table($categoryTable.' as c')
            ->leftJoin($categoryLangTable.' as cl', function ($join) use ($langId): void {
                $join
                    ->on('cl.id_cms_category', '=', 'c.id_cms_category')
                    ->where('cl.id_lang', '=', $langId);
            })
            ->leftJoin($categoryTable.' as p', 'p.id_cms_category', '=', 'c.id_parent')
            ->leftJoin($categoryLangTable.' as pl', function ($join) use ($langId): void {
                $join
                    ->on('pl.id_cms_category', '=', 'p.id_cms_category')
                    ->where('pl.id_lang', '=', $langId);
            })
            ->where('c.id_cms_category', $categoryId)
            ->select([
                'c.id_cms_category',
                'c.id_parent',
                'c.level_depth',
                'c.active',
                'c.position',
                'c.date_add',
                'c.date_upd',
                'cl.name',
                'pl.name as parent_name',
            ])
            ->first();

        if ($row === null) {
            throw new RuntimeException('CMS category not found in PrestaShop database.');
        }

        return [
            'id_cms_category' => (int) data_get($row, 'id_cms_category', 0),
            'id_parent' => (int) data_get($row, 'id_parent', 0),
            'level_depth' => (int) data_get($row, 'level_depth', 0),
            'active' => (bool) data_get($row, 'active', false),
            'position' => max(0, (int) data_get($row, 'position', 0)),
            'date_add' => $this->nullableString(data_get($row, 'date_add')),
            'date_upd' => $this->nullableString(data_get($row, 'date_upd')),
            'name' => trim((string) data_get($row, 'name', '')),
            'parent_name' => trim((string) data_get($row, 'parent_name', '')),
        ];
    }

    /**
     * @param  array{name:mixed,id_parent:mixed,active:mixed}  $payload
     */
    public function createCategory(int $langId, array $payload): int
    {
        $this->resolveTenantId();

        if ($langId < 1) {
            throw new RuntimeException('Language is required.');
        }

        $resolvedPayload = $this->resolveCreatePayload($payload);
        $categoryTable = $this->tenantPrestaShopConnection->table('cms_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('cms_category_lang');
        $now = now()->format('Y-m-d H:i:s');

        return (int) DB::connection('tenant_ps')->transaction(function () use (
            $langId,
            $resolvedPayload,
            $categoryTable,
            $categoryLangTable,
            $now
        ): int {
            $parentDepth = $this->resolveParentDepth($resolvedPayload['id_parent']);
            $newDepth = $parentDepth + 1;
            $newPosition = $this->resolveNextPosition($resolvedPayload['id_parent']);

            $newCategoryId = (int) DB::connection('tenant_ps')
                ->table($categoryTable)
                ->insertGetId([
                    'id_parent' => $resolvedPayload['id_parent'],
                    'level_depth' => $newDepth,
                    'active' => (int) $resolvedPayload['active'],
                    'position' => $newPosition,
                    'date_add' => $now,
                    'date_upd' => $now,
                ], 'id_cms_category');

            if ($newCategoryId < 1) {
                throw new RuntimeException('Unable to create CMS category.');
            }

            $languageIds = $this->resolveLanguageIds();

            if ($languageIds === []) {
                $languageIds = [$langId];
            }

            foreach ($languageIds as $languageId) {
                DB::connection('tenant_ps')
                    ->table($categoryLangTable)
                    ->updateOrInsert(
                        [
                            'id_cms_category' => $newCategoryId,
                            'id_lang' => $languageId,
                        ],
                        [
                            'name' => $resolvedPayload['name'],
                        ],
                    );
            }

            return $newCategoryId;
        });
    }

    /**
     * @param  array{name:mixed,id_parent:mixed,active:mixed,position:mixed}  $payload
     */
    public function updateCategory(int $categoryId, int $langId, array $payload): void
    {
        $this->resolveTenantId();

        if ($categoryId < 1 || $langId < 1) {
            throw new RuntimeException('Category and language are required.');
        }

        $resolvedPayload = $this->resolveUpdatePayload($payload);
        $categoryTable = $this->tenantPrestaShopConnection->table('cms_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('cms_category_lang');

        DB::connection('tenant_ps')->transaction(function () use (
            $categoryId,
            $langId,
            $resolvedPayload,
            $categoryTable,
            $categoryLangTable
        ): void {
            /** @var object{id_parent:int|string}|null $currentRow */
            $currentRow = DB::connection('tenant_ps')
                ->table($categoryTable)
                ->where('id_cms_category', $categoryId)
                ->first(['id_parent']);

            if ($currentRow === null) {
                throw new RuntimeException('CMS category not found in PrestaShop database.');
            }

            $currentParentId = (int) data_get($currentRow, 'id_parent', 0);
            $nextParentId = $resolvedPayload['id_parent'];
            $parentChanged = $currentParentId !== $nextParentId;

            $tree = $this->loadTreeForMutation();
            $this->assertNoCycle(
                categoryId: $categoryId,
                proposedParentId: $nextParentId,
                categories: $tree['categories'],
                childrenByParent: $tree['children_by_parent'],
            );

            $nextDepth = $this->resolveParentDepth($nextParentId) + 1;
            $position = $resolvedPayload['position'];

            if ($position === null && $parentChanged) {
                $position = $this->resolveNextPosition($nextParentId);
            }

            $updateData = [
                'active' => (int) $resolvedPayload['active'],
                'id_parent' => $nextParentId,
                'level_depth' => $nextDepth,
                'date_upd' => now()->format('Y-m-d H:i:s'),
            ];

            if ($position !== null) {
                $updateData['position'] = $position;
            }

            DB::connection('tenant_ps')
                ->table($categoryTable)
                ->where('id_cms_category', $categoryId)
                ->update($updateData);

            if ($parentChanged) {
                $this->updateDescendantDepths(
                    categoryId: $categoryId,
                    categoryTable: $categoryTable,
                    categories: $tree['categories'],
                    childrenByParent: $tree['children_by_parent'],
                    rootDepth: $nextDepth,
                );
            }

            DB::connection('tenant_ps')
                ->table($categoryLangTable)
                ->updateOrInsert(
                    [
                        'id_cms_category' => $categoryId,
                        'id_lang' => $langId,
                    ],
                    [
                        'name' => $resolvedPayload['name'],
                    ],
                );
        });
    }

    /**
     * @return list<int>
     */
    public function getDisallowedParentIds(int $categoryId): array
    {
        $this->resolveTenantId();

        if ($categoryId < 1) {
            return [];
        }

        $tree = $this->loadTreeForMutation();
        $childrenByParent = $tree['children_by_parent'];
        $queue = [$categoryId];
        $disallowed = [$categoryId];

        while ($queue !== []) {
            $current = array_shift($queue);

            if (! is_int($current) || $current < 1) {
                continue;
            }

            foreach ($childrenByParent[$current] ?? [] as $childId) {
                if (in_array($childId, $disallowed, true)) {
                    continue;
                }

                $disallowed[] = $childId;
                $queue[] = $childId;
            }
        }

        return $disallowed;
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
     * @return array{
     *     categories:array<int, array{id:int,id_parent:int,level_depth:int,active:bool,position:int}>,
     *     names:array<int, string>
     * }
     */
    private function loadCategoryTreeData(int $langId): array
    {
        $categoryTable = $this->tenantPrestaShopConnection->table('cms_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('cms_category_lang');

        /** @var array<int, object{id_cms_category:int|string,id_parent:int|string,level_depth:mixed,active:mixed,position:mixed}> $rows */
        $rows = DB::connection('tenant_ps')
            ->table($categoryTable)
            ->orderBy('level_depth')
            ->orderBy('position')
            ->orderBy('id_cms_category')
            ->get(['id_cms_category', 'id_parent', 'level_depth', 'active', 'position'])
            ->all();

        /** @var array<int, array{id:int,id_parent:int,level_depth:int,active:bool,position:int}> $categories */
        $categories = [];

        foreach ($rows as $row) {
            $categoryId = (int) data_get($row, 'id_cms_category', 0);

            if ($categoryId < 1) {
                continue;
            }

            $categories[$categoryId] = [
                'id' => $categoryId,
                'id_parent' => (int) data_get($row, 'id_parent', 0),
                'level_depth' => (int) data_get($row, 'level_depth', 0),
                'active' => (bool) data_get($row, 'active', false),
                'position' => max(0, (int) data_get($row, 'position', 0)),
            ];
        }

        /** @var array<int, string> $names */
        $names = DB::connection('tenant_ps')
            ->table($categoryLangTable)
            ->where('id_lang', $langId)
            ->pluck('name', 'id_cms_category')
            ->mapWithKeys(fn (mixed $name, mixed $id): array => [(int) $id => trim((string) $name)])
            ->filter(fn (string $name): bool => $name !== '')
            ->all();

        return [
            'categories' => $categories,
            'names' => $names,
        ];
    }

    /**
     * @return array{
     *     categories:array<int, array{id:int,id_parent:int,level_depth:int}>,
     *     children_by_parent:array<int, list<int>>
     * }
     */
    private function loadTreeForMutation(): array
    {
        $categoryTable = $this->tenantPrestaShopConnection->table('cms_category');

        /** @var array<int, object{id_cms_category:int|string,id_parent:int|string,level_depth:mixed}> $rows */
        $rows = DB::connection('tenant_ps')
            ->table($categoryTable)
            ->get(['id_cms_category', 'id_parent', 'level_depth'])
            ->all();

        /** @var array<int, array{id:int,id_parent:int,level_depth:int}> $categories */
        $categories = [];
        /** @var array<int, list<int>> $childrenByParent */
        $childrenByParent = [];

        foreach ($rows as $row) {
            $categoryId = (int) data_get($row, 'id_cms_category', 0);

            if ($categoryId < 1) {
                continue;
            }

            $parentId = (int) data_get($row, 'id_parent', 0);

            $categories[$categoryId] = [
                'id' => $categoryId,
                'id_parent' => $parentId,
                'level_depth' => (int) data_get($row, 'level_depth', 0),
            ];

            if (! array_key_exists($parentId, $childrenByParent)) {
                $childrenByParent[$parentId] = [];
            }

            $childrenByParent[$parentId][] = $categoryId;
        }

        return [
            'categories' => $categories,
            'children_by_parent' => $childrenByParent,
        ];
    }

    /**
     * @param  array{name:mixed,id_parent:mixed,active:mixed}  $payload
     * @return array{name:string,id_parent:int,active:bool}
     */
    private function resolveCreatePayload(array $payload): array
    {
        $name = trim((string) ($payload['name'] ?? ''));

        if ($name === '') {
            throw new RuntimeException('Category name is required.');
        }

        if (mb_strlen($name) > 255) {
            throw new RuntimeException('Category name may not be greater than 255 characters.');
        }

        $parentId = max(0, (int) ($payload['id_parent'] ?? 0));

        return [
            'name' => $name,
            'id_parent' => $parentId,
            'active' => (bool) ($payload['active'] ?? false),
        ];
    }

    /**
     * @param  array{name:mixed,id_parent:mixed,active:mixed,position:mixed}  $payload
     * @return array{name:string,id_parent:int,active:bool,position:?int}
     */
    private function resolveUpdatePayload(array $payload): array
    {
        $resolved = $this->resolveCreatePayload($payload);
        $positionValue = $payload['position'] ?? null;
        $position = null;

        if ($positionValue !== null && $positionValue !== '') {
            $position = max(0, (int) $positionValue);
        }

        return [
            ...$resolved,
            'position' => $position,
        ];
    }

    private function resolveParentDepth(int $parentId): int
    {
        if ($parentId < 1) {
            return 0;
        }

        $categoryTable = $this->tenantPrestaShopConnection->table('cms_category');

        /** @var int|string|null $depth */
        $depth = DB::connection('tenant_ps')
            ->table($categoryTable)
            ->where('id_cms_category', $parentId)
            ->value('level_depth');

        return (int) ($depth ?? 0);
    }

    private function resolveNextPosition(int $parentId): int
    {
        $categoryTable = $this->tenantPrestaShopConnection->table('cms_category');

        /** @var int|string|null $position */
        $position = DB::connection('tenant_ps')
            ->table($categoryTable)
            ->where('id_parent', $parentId)
            ->max('position');

        return max(0, (int) ($position ?? -1)) + 1;
    }

    /**
     * @return list<int>
     */
    private function resolveLanguageIds(): array
    {
        $languageTable = $this->tenantPrestaShopConnection->table('lang');

        return DB::connection('tenant_ps')
            ->table($languageTable)
            ->pluck('id_lang')
            ->map(fn (mixed $value): int => (int) $value)
            ->filter(fn (int $id): bool => $id > 0)
            ->values()
            ->all();
    }

    /**
     * @param  array<int, array{id:int,id_parent:int,level_depth:int}>  $categories
     * @param  array<int, list<int>>  $childrenByParent
     */
    private function assertNoCycle(int $categoryId, int $proposedParentId, array $categories, array $childrenByParent): void
    {
        if ($proposedParentId < 1) {
            return;
        }

        if ($proposedParentId === $categoryId) {
            throw new RuntimeException('A category cannot be its own parent.');
        }

        if (! array_key_exists($proposedParentId, $categories)) {
            return;
        }

        $descendants = $this->collectDescendantIds($categoryId, $childrenByParent);

        if (in_array($proposedParentId, $descendants, true)) {
            throw new RuntimeException('A category cannot be moved under one of its descendants.');
        }
    }

    /**
     * @param  array<int, list<int>>  $childrenByParent
     * @return list<int>
     */
    private function collectDescendantIds(int $categoryId, array $childrenByParent): array
    {
        $descendants = [];
        $queue = [$categoryId];

        while ($queue !== []) {
            $current = array_shift($queue);

            if (! is_int($current) || $current < 1) {
                continue;
            }

            foreach ($childrenByParent[$current] ?? [] as $childId) {
                if (in_array($childId, $descendants, true)) {
                    continue;
                }

                $descendants[] = $childId;
                $queue[] = $childId;
            }
        }

        return $descendants;
    }

    /**
     * @param  array<int, array{id:int,id_parent:int,level_depth:int}>  $categories
     * @param  array<int, list<int>>  $childrenByParent
     */
    private function updateDescendantDepths(
        int $categoryId,
        string $categoryTable,
        array $categories,
        array $childrenByParent,
        int $rootDepth,
    ): void {
        $queue = [$categoryId];
        $depthMap = [$categoryId => $rootDepth];

        while ($queue !== []) {
            $current = array_shift($queue);

            if (! is_int($current) || $current < 1) {
                continue;
            }

            $currentDepth = $depthMap[$current] ?? null;

            if (! is_int($currentDepth)) {
                continue;
            }

            foreach ($childrenByParent[$current] ?? [] as $childId) {
                if (! array_key_exists($childId, $categories)) {
                    continue;
                }

                $childDepth = $currentDepth + 1;
                $depthMap[$childId] = $childDepth;
                $queue[] = $childId;

                DB::connection('tenant_ps')
                    ->table($categoryTable)
                    ->where('id_cms_category', $childId)
                    ->update([
                        'level_depth' => $childDepth,
                        'date_upd' => now()->format('Y-m-d H:i:s'),
                    ]);
            }
        }
    }

    private function nullableString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $string = trim((string) $value);

        return $string === '' ? null : $string;
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
