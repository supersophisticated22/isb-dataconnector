<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use RuntimeException;

class TenantPrestaShopCmsPageService
{
    /**
     * @var array<string, bool>
     */
    private array $columnPresence = [];

    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
    ) {}

    /**
     * @param  array<string, mixed>  $filters
     * @return LengthAwarePaginator<int, object>|array<int, array<string, mixed>>
     */
    public function listPages(int $langId, array $filters = []): LengthAwarePaginator|array
    {
        $this->resolveTenantId();

        if ($langId < 1) {
            return [];
        }

        $cmsTable = $this->tenantPrestaShopConnection->table('cms');
        $cmsLangTable = $this->tenantPrestaShopConnection->table('cms_lang');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('cms_category_lang');

        $query = DB::connection('tenant_ps')
            ->table($cmsTable.' as c')
            ->leftJoin($cmsLangTable.' as cl', function ($join) use ($langId, $cmsLangTable): void {
                $join
                    ->on('cl.id_cms', '=', 'c.id_cms')
                    ->where('cl.id_lang', '=', $langId);

                if ($this->hasColumn($cmsLangTable, 'id_shop')) {
                    $join->where('cl.id_shop', '=', $this->resolveReadShopId());
                }
            })
            ->leftJoin($categoryLangTable.' as ccl', function ($join) use ($langId): void {
                $join
                    ->on('ccl.id_cms_category', '=', 'c.id_cms_category')
                    ->where('ccl.id_lang', '=', $langId);
            })
            ->orderByDesc('c.id_cms')
            ->select([
                'c.id_cms',
                'c.id_cms_category',
                'c.active',
                'c.position',
                'cl.meta_title',
                'cl.link_rewrite',
                'ccl.name as category_name',
            ]);

        if ($this->hasColumn($cmsTable, 'indexation')) {
            $query->addSelect('c.indexation');
        }

        $search = trim((string) ($filters['search'] ?? ''));

        if ($search !== '') {
            $query->where(function ($nested) use ($search): void {
                $nested
                    ->where('cl.meta_title', 'like', '%'.$search.'%')
                    ->orWhere('cl.link_rewrite', 'like', '%'.$search.'%');
            });
        }

        if (array_key_exists('active', $filters) && $filters['active'] !== null) {
            $query->where('c.active', (bool) $filters['active']);
        }

        $categoryId = (int) ($filters['id_cms_category'] ?? 0);

        if ($categoryId > 0) {
            $query->where('c.id_cms_category', $categoryId);
        }

        $perPage = max(1, (int) ($filters['per_page'] ?? 25));

        return $query->paginate($perPage);
    }

    /**
     * @return array{
     *     id_cms:int,
     *     id_cms_category:int,
     *     active:bool,
     *     position:?int,
     *     indexation:?bool,
     *     meta_title:?string,
     *     meta_description:?string,
     *     meta_keywords:?string,
     *     link_rewrite:string,
     *     content:?string,
     *     category_label:string,
     *     shop_ids:list<int>
     * }
     */
    public function getPage(int $cmsId, int $langId): array
    {
        $this->resolveTenantId();

        if ($cmsId < 1 || $langId < 1) {
            throw new RuntimeException('CMS page and language are required.');
        }

        $cmsTable = $this->tenantPrestaShopConnection->table('cms');
        $cmsLangTable = $this->tenantPrestaShopConnection->table('cms_lang');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('cms_category_lang');

        $query = DB::connection('tenant_ps')
            ->table($cmsTable.' as c')
            ->leftJoin($cmsLangTable.' as cl', function ($join) use ($langId, $cmsLangTable): void {
                $join
                    ->on('cl.id_cms', '=', 'c.id_cms')
                    ->where('cl.id_lang', '=', $langId);

                if ($this->hasColumn($cmsLangTable, 'id_shop')) {
                    $join->where('cl.id_shop', '=', $this->resolveReadShopId());
                }
            })
            ->leftJoin($categoryLangTable.' as ccl', function ($join) use ($langId): void {
                $join
                    ->on('ccl.id_cms_category', '=', 'c.id_cms_category')
                    ->where('ccl.id_lang', '=', $langId);
            })
            ->where('c.id_cms', $cmsId)
            ->select([
                'c.id_cms',
                'c.id_cms_category',
                'c.active',
                'c.position',
                'cl.meta_title',
                'cl.meta_description',
                'cl.meta_keywords',
                'cl.link_rewrite',
                'cl.content',
                'ccl.name as category_name',
            ]);

        if ($this->hasColumn($cmsTable, 'indexation')) {
            $query->addSelect('c.indexation');
        }

        /** @var object{id_cms:int|string,id_cms_category:int|string,active:mixed,position:mixed,indexation:mixed,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:?string,content:?string,category_name:?string}|null $row */
        $row = $query->first();

        if ($row === null) {
            throw new RuntimeException('CMS page not found in PrestaShop database.');
        }

        return [
            'id_cms' => (int) data_get($row, 'id_cms', 0),
            'id_cms_category' => (int) data_get($row, 'id_cms_category', 0),
            'active' => (bool) data_get($row, 'active', false),
            'position' => $this->nullableInt(data_get($row, 'position')),
            'indexation' => $this->hasColumn($cmsTable, 'indexation')
                ? (bool) data_get($row, 'indexation', false)
                : null,
            'meta_title' => $this->nullableString(data_get($row, 'meta_title')),
            'meta_description' => $this->nullableString(data_get($row, 'meta_description')),
            'meta_keywords' => $this->nullableString(data_get($row, 'meta_keywords')),
            'link_rewrite' => (string) data_get($row, 'link_rewrite', ''),
            'content' => $this->nullableString(data_get($row, 'content')),
            'category_label' => (string) data_get($row, 'category_name', ''),
            'shop_ids' => $this->resolveShopIds(cmsId: $cmsId),
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function upsertPage(int $langId, array $payload, ?int $cmsId = null): int
    {
        $this->resolveTenantId();

        if ($langId < 1) {
            throw new RuntimeException('Language is required.');
        }

        $resolvedPayload = $this->resolvePayload($payload);
        $cmsTable = $this->tenantPrestaShopConnection->table('cms');

        return (int) DB::connection('tenant_ps')->transaction(function () use ($langId, $resolvedPayload, $cmsId, $cmsTable): int {
            $resolvedCmsId = $cmsId;

            if ($resolvedCmsId !== null && $resolvedCmsId > 0) {
                $this->assertCmsPageExists($resolvedCmsId);

                DB::connection('tenant_ps')
                    ->table($cmsTable)
                    ->where('id_cms', $resolvedCmsId)
                    ->update($resolvedPayload['base']);
            } else {
                $insertPayload = $this->resolveInsertPayload(
                    table: $cmsTable,
                    keyValues: $resolvedPayload['base'],
                    primaryKey: 'id_cms',
                );

                $resolvedCmsId = (int) DB::connection('tenant_ps')
                    ->table($cmsTable)
                    ->insertGetId($insertPayload);
            }

            $shopIds = $this->ensureCmsShopAssociation($resolvedCmsId, $resolvedPayload['shop_ids']);

            $this->upsertCmsLanguage(
                cmsId: $resolvedCmsId,
                langId: $langId,
                langPayload: $resolvedPayload['lang'],
                shopIds: $shopIds,
            );

            return $resolvedCmsId;
        });
    }

    /**
     * @param  array<string, mixed>  $langPayload
     */
    public function updatePageLanguage(int $cmsId, int $langId, array $langPayload): void
    {
        $this->resolveTenantId();

        if ($cmsId < 1 || $langId < 1) {
            throw new RuntimeException('CMS page and language are required.');
        }

        $resolvedLangPayload = $this->resolveLangPayload($langPayload);

        DB::connection('tenant_ps')->transaction(function () use ($cmsId, $langId, $resolvedLangPayload): void {
            $this->assertCmsPageExists($cmsId);

            $shopIds = $this->ensureCmsShopAssociation($cmsId);

            $this->upsertCmsLanguage(
                cmsId: $cmsId,
                langId: $langId,
                langPayload: $resolvedLangPayload,
                shopIds: $shopIds,
            );
        });
    }

    /**
     * @return array<int, string>
     */
    public function getLanguageOptions(): array
    {
        $this->resolveTenantId();

        $languageTable = $this->tenantPrestaShopConnection->table('lang');

        /** @var array<int, string> $options */
        $options = DB::connection('tenant_ps')
            ->table($languageTable)
            ->orderBy('id_lang')
            ->get(['id_lang', 'name', 'iso_code'])
            ->mapWithKeys(function (object $language): array {
                $idLang = (int) data_get($language, 'id_lang', 0);
                $name = trim((string) data_get($language, 'name', ''));
                $isoCode = strtoupper(trim((string) data_get($language, 'iso_code', '')));

                if ($idLang < 1 || $name === '') {
                    return [];
                }

                return [$idLang => $isoCode !== '' ? $name.' ('.$isoCode.')' : $name];
            })
            ->all();

        return $options;
    }

    public function resolveDefaultLanguageId(): int
    {
        $options = $this->getLanguageOptions();

        return (int) (array_key_first($options) ?? 0);
    }

    public function resolveReadShopId(): int
    {
        $shopIds = $this->resolveShopIds();

        return (int) ($shopIds[0] ?? 1);
    }

    /**
     * @param  list<int|string>  $orderedCmsIds
     */
    public function reorderPages(array $orderedCmsIds): void
    {
        $this->resolveTenantId();

        $cmsIds = collect($orderedCmsIds)
            ->map(fn (int|string $value): int => (int) $value)
            ->filter(fn (int $cmsId): bool => $cmsId > 0)
            ->values()
            ->all();

        if ($cmsIds === []) {
            return;
        }

        $cmsTable = $this->tenantPrestaShopConnection->table('cms');

        if (! $this->hasColumn($cmsTable, 'position')) {
            throw new RuntimeException('Position column is not available for CMS pages.');
        }

        DB::connection('tenant_ps')->transaction(function () use ($cmsIds, $cmsTable): void {
            foreach ($cmsIds as $index => $cmsId) {
                DB::connection('tenant_ps')
                    ->table($cmsTable)
                    ->where('id_cms', $cmsId)
                    ->update([
                        'position' => $index + 1,
                    ]);
            }
        });
    }

    public function hasCmsColumn(string $column): bool
    {
        $this->resolveTenantId();

        return $this->hasColumn($this->tenantPrestaShopConnection->table('cms'), $column);
    }

    public function hasCmsLangColumn(string $column): bool
    {
        $this->resolveTenantId();

        return $this->hasColumn($this->tenantPrestaShopConnection->table('cms_lang'), $column);
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array{
     *     base:array<string, mixed>,
     *     lang:array<string, mixed>,
     *     shop_ids:list<int>
     * }
     */
    private function resolvePayload(array $payload): array
    {
        $categoryId = (int) ($payload['id_cms_category'] ?? 0);

        if ($categoryId < 1) {
            throw new RuntimeException('Category is required.');
        }

        $basePayload = [
            'id_cms_category' => $categoryId,
            'active' => (int) ((bool) ($payload['active'] ?? false)),
        ];

        $cmsTable = $this->tenantPrestaShopConnection->table('cms');

        if (array_key_exists('position', $payload) && $this->hasColumn($cmsTable, 'position')) {
            $position = $payload['position'];

            $basePayload['position'] = $position === null || $position === ''
                ? null
                : (int) $position;
        }

        if (array_key_exists('indexation', $payload) && $this->hasColumn($cmsTable, 'indexation')) {
            $basePayload['indexation'] = (int) ((bool) $payload['indexation']);
        }

        return [
            'base' => $basePayload,
            'lang' => $this->resolveLangPayload($payload),
            'shop_ids' => $this->resolveExplicitShopIds($payload['shop_ids'] ?? null),
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array{meta_title:string,meta_description:?string,meta_keywords:?string,link_rewrite:string,content:?string}
     */
    private function resolveLangPayload(array $payload): array
    {
        $metaTitle = trim((string) ($payload['meta_title'] ?? ''));

        if ($metaTitle === '') {
            throw new RuntimeException('Meta title is required.');
        }

        if (Str::length($metaTitle) > 255) {
            $metaTitle = trim(Str::substr($metaTitle, 0, 255));
        }

        $linkRewrite = $this->sanitizeSlug((string) ($payload['link_rewrite'] ?? ''));

        if ($linkRewrite === '') {
            throw new RuntimeException('Slug is required.');
        }

        if (Str::length($linkRewrite) > 128) {
            $linkRewrite = trim(Str::substr($linkRewrite, 0, 128), '-');
        }

        if ($linkRewrite === '') {
            throw new RuntimeException('Slug is invalid.');
        }

        return [
            'meta_title' => $metaTitle,
            'meta_description' => $this->nullableString($payload['meta_description'] ?? null),
            'meta_keywords' => $this->nullableString($payload['meta_keywords'] ?? null),
            'link_rewrite' => $linkRewrite,
            'content' => $this->nullableString($payload['content'] ?? null),
        ];
    }

    /**
     * @param  array<string, mixed>  $langPayload
     * @param  list<int>  $shopIds
     */
    private function upsertCmsLanguage(int $cmsId, int $langId, array $langPayload, array $shopIds): void
    {
        $cmsLangTable = $this->tenantPrestaShopConnection->table('cms_lang');
        $hasShopColumn = $this->hasColumn($cmsLangTable, 'id_shop');
        $targetShopIds = $hasShopColumn ? $shopIds : [0];

        foreach ($targetShopIds as $shopId) {
            $query = DB::connection('tenant_ps')
                ->table($cmsLangTable)
                ->where('id_cms', $cmsId)
                ->where('id_lang', $langId);

            if ($hasShopColumn) {
                $query->where('id_shop', $shopId);
            }

            $exists = $query->exists();

            if ($exists) {
                $query->update($langPayload);

                continue;
            }

            $keyValues = [
                'id_cms' => $cmsId,
                'id_lang' => $langId,
                ...($hasShopColumn ? ['id_shop' => $shopId] : []),
                ...$langPayload,
            ];

            $insertPayload = $this->resolveInsertPayload(
                table: $cmsLangTable,
                keyValues: $keyValues,
                primaryKey: null,
            );

            DB::connection('tenant_ps')
                ->table($cmsLangTable)
                ->insert($insertPayload);
        }
    }

    /**
     * @param  list<int>|null  $requestedShopIds
     * @return list<int>
     */
    private function ensureCmsShopAssociation(int $cmsId, ?array $requestedShopIds = null): array
    {
        $shopIds = $requestedShopIds ?? $this->resolveShopIds(cmsId: $cmsId);

        if ($shopIds === []) {
            $shopIds = [1];
        }

        $cmsShopTable = $this->tenantPrestaShopConnection->table('cms_shop');

        if (! $this->tableExists($cmsShopTable)) {
            return $shopIds;
        }

        foreach ($shopIds as $shopId) {
            $exists = DB::connection('tenant_ps')
                ->table($cmsShopTable)
                ->where('id_cms', $cmsId)
                ->where('id_shop', $shopId)
                ->exists();

            if ($exists) {
                continue;
            }

            $insertPayload = $this->resolveInsertPayload(
                table: $cmsShopTable,
                keyValues: [
                    'id_cms' => $cmsId,
                    'id_shop' => $shopId,
                ],
                primaryKey: null,
            );

            DB::connection('tenant_ps')
                ->table($cmsShopTable)
                ->insert($insertPayload);
        }

        return $shopIds;
    }

    /**
     * @return list<int>
     */
    private function resolveShopIds(?int $cmsId = null): array
    {
        $cmsShopTable = $this->tenantPrestaShopConnection->table('cms_shop');

        if ($this->tableExists($cmsShopTable)) {
            if ($cmsId !== null && $cmsId > 0) {
                /** @var list<int> $shopIds */
                $shopIds = DB::connection('tenant_ps')
                    ->table($cmsShopTable)
                    ->where('id_cms', $cmsId)
                    ->orderBy('id_shop')
                    ->pluck('id_shop')
                    ->map(fn (mixed $value): int => (int) $value)
                    ->filter(fn (int $shopId): bool => $shopId > 0)
                    ->values()
                    ->all();

                if ($shopIds !== []) {
                    return $shopIds;
                }
            }

            /** @var list<int> $shopIds */
            $shopIds = DB::connection('tenant_ps')
                ->table($cmsShopTable)
                ->distinct()
                ->orderBy('id_shop')
                ->pluck('id_shop')
                ->map(fn (mixed $value): int => (int) $value)
                ->filter(fn (int $shopId): bool => $shopId > 0)
                ->values()
                ->all();

            if ($shopIds !== []) {
                return $shopIds;
            }
        }

        $shopTable = $this->tenantPrestaShopConnection->table('shop');

        if ($this->tableExists($shopTable)) {
            /** @var list<int> $shopIds */
            $shopIds = DB::connection('tenant_ps')
                ->table($shopTable)
                ->orderBy('id_shop')
                ->pluck('id_shop')
                ->map(fn (mixed $value): int => (int) $value)
                ->filter(fn (int $shopId): bool => $shopId > 0)
                ->values()
                ->all();

            if ($shopIds !== []) {
                return $shopIds;
            }
        }

        return [1];
    }

    /**
     * @param  array<string, mixed>  $keyValues
     * @return array<string, mixed>
     */
    private function resolveInsertPayload(string $table, array $keyValues, ?string $primaryKey): array
    {
        $template = DB::connection('tenant_ps')
            ->table($table)
            ->first();

        /** @var array<string, mixed> $insertPayload */
        $insertPayload = is_object($template) ? (array) $template : [];

        if ($primaryKey !== null) {
            unset($insertPayload[$primaryKey]);
        }

        foreach ($keyValues as $column => $value) {
            $insertPayload[$column] = $value;
        }

        if ($template === null) {
            foreach ($this->resolveRequiredColumns($table) as $column => $type) {
                if (array_key_exists($column, $insertPayload)) {
                    continue;
                }

                if ($primaryKey !== null && $column === $primaryKey) {
                    continue;
                }

                $insertPayload[$column] = $this->resolveRequiredColumnDefaultValue($type);
            }
        }

        return $insertPayload;
    }

    /**
     * @return array<string, string>
     */
    private function resolveRequiredColumns(string $table): array
    {
        $driver = DB::connection('tenant_ps')->getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            return $this->resolveRequiredColumnsFromInformationSchema($table);
        }

        if ($driver === 'sqlite') {
            return $this->resolveRequiredColumnsFromSqlite($table);
        }

        return [];
    }

    /**
     * @return array<string, string>
     */
    private function resolveRequiredColumnsFromInformationSchema(string $table): array
    {
        $databaseName = DB::connection('tenant_ps')->getDatabaseName();

        if ($databaseName === '') {
            return [];
        }

        /** @var array<int, object{column_name:string,data_type:?string,column_default:mixed,is_nullable:string,extra:?string}> $rows */
        $rows = DB::connection('tenant_ps')
            ->table('information_schema.columns')
            ->where('table_schema', $databaseName)
            ->where('table_name', $table)
            ->get(['column_name', 'data_type', 'column_default', 'is_nullable', 'extra'])
            ->all();

        $columns = [];

        foreach ($rows as $row) {
            if (strtoupper((string) $row->is_nullable) === 'YES') {
                continue;
            }

            if ($row->column_default !== null) {
                continue;
            }

            if (Str::contains(strtolower((string) ($row->extra ?? '')), 'auto_increment')) {
                continue;
            }

            $columns[$row->column_name] = strtolower((string) ($row->data_type ?? ''));
        }

        return $columns;
    }

    /**
     * @return array<string, string>
     */
    private function resolveRequiredColumnsFromSqlite(string $table): array
    {
        $quotedTable = str_replace("'", "''", $table);

        /** @var array<int, object{name:string,type:string,notnull:int|string,dflt_value:mixed,pk:int|string}> $rows */
        $rows = DB::connection('tenant_ps')->select("PRAGMA table_info('{$quotedTable}')");

        $columns = [];

        foreach ($rows as $row) {
            if ((int) $row->notnull !== 1) {
                continue;
            }

            if ($row->dflt_value !== null) {
                continue;
            }

            if ((int) $row->pk === 1) {
                continue;
            }

            $columns[(string) $row->name] = strtolower((string) $row->type);
        }

        return $columns;
    }

    private function resolveRequiredColumnDefaultValue(string $columnType): mixed
    {
        if (Str::contains($columnType, ['int', 'decimal', 'float', 'double', 'real', 'numeric', 'bit', 'bool'])) {
            return 0;
        }

        if (Str::contains($columnType, ['date', 'time'])) {
            return now()->toDateTimeString();
        }

        if (Str::contains($columnType, ['char', 'text', 'enum', 'set', 'json'])) {
            return '';
        }

        return '';
    }

    private function assertCmsPageExists(int $cmsId): void
    {
        $cmsTable = $this->tenantPrestaShopConnection->table('cms');

        $exists = DB::connection('tenant_ps')
            ->table($cmsTable)
            ->where('id_cms', $cmsId)
            ->exists();

        if (! $exists) {
            throw new RuntimeException('CMS page not found in PrestaShop database.');
        }
    }

    private function hasColumn(string $table, string $column): bool
    {
        $cacheKey = $table.':'.$column;

        if (! array_key_exists($cacheKey, $this->columnPresence)) {
            $this->columnPresence[$cacheKey] = Schema::connection('tenant_ps')->hasColumn($table, $column);
        }

        return $this->columnPresence[$cacheKey];
    }

    private function tableExists(string $table): bool
    {
        return Schema::connection('tenant_ps')->hasTable($table);
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

        $resolvedValue = trim((string) $value);

        return $resolvedValue === '' ? null : $resolvedValue;
    }

    private function nullableInt(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (int) $value;
    }

    /**
     * @return list<int>
     */
    private function resolveExplicitShopIds(mixed $shopIds): array
    {
        if (! is_array($shopIds)) {
            return [];
        }

        /** @var list<int> $resolved */
        $resolved = collect($shopIds)
            ->map(fn (mixed $value): int => (int) $value)
            ->filter(fn (int $shopId): bool => $shopId > 0)
            ->unique()
            ->values()
            ->all();

        return $resolved;
    }

    private function resolveTenantId(): int
    {
        $tenantId = $this->tenantContext->tenantId();

        if (! is_int($tenantId) || $tenantId < 1) {
            throw new RuntimeException('Tenant context is missing.');
        }

        return $tenantId;
    }
}
