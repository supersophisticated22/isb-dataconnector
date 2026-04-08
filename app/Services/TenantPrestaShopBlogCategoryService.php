<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class TenantPrestaShopBlogCategoryService
{
    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
    ) {}

    /**
     * @return LengthAwarePaginator<int, object>|array<int, array<string, mixed>>
     */
    public function listCategories(int $perPage = 25): LengthAwarePaginator|array
    {
        $this->resolveTenantId();

        $langId = $this->resolveDefaultLanguageId();

        if ($langId < 1) {
            return [];
        }

        $categoryTable = $this->tenantPrestaShopConnection->table('ets_blog_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('ets_blog_category_lang');
        $resolvedPerPage = max(1, $perPage);

        return DB::connection('tenant_ps')
            ->table($categoryTable.' as c')
            ->leftJoin($categoryLangTable.' as cl', function ($join) use ($langId): void {
                $join
                    ->on('cl.id_category', '=', 'c.id_category')
                    ->where('cl.id_lang', '=', $langId);
            })
            ->leftJoin($categoryTable.' as p', 'p.id_category', '=', 'c.id_parent')
            ->leftJoin($categoryLangTable.' as pl', function ($join) use ($langId): void {
                $join
                    ->on('pl.id_category', '=', 'p.id_category')
                    ->where('pl.id_lang', '=', $langId);
            })
            ->orderBy('c.sort_order')
            ->orderBy('c.id_category')
            ->select([
                'c.id_category',
                'c.id_parent',
                'c.enabled',
                'c.sort_order',
                'c.date_add',
                'c.date_upd',
                'cl.title',
                'cl.url_alias',
                'cl.meta_title',
                'pl.title as parent_title',
            ])
            ->paginate($resolvedPerPage);
    }

    /**
     * @return array{
     *     id_category:int,
     *     id_parent:int,
     *     enabled:bool,
     *     sort_order:int,
     *     title:string,
     *     url_alias:string,
     *     meta_title:string,
     *     description:?string,
     *     meta_keywords:string,
     *     meta_description:?string,
     *     image:?string,
     *     thumb:?string
     * }
     */
    public function getCategory(int $categoryId): array
    {
        $this->resolveTenantId();

        if ($categoryId < 1) {
            throw new RuntimeException('Blog category is required.');
        }

        $langId = $this->resolveDefaultLanguageId();

        if ($langId < 1) {
            throw new RuntimeException('Default language is missing.');
        }

        $categoryTable = $this->tenantPrestaShopConnection->table('ets_blog_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('ets_blog_category_lang');

        /** @var object{id_category:int|string,id_parent:int|string,enabled:mixed,sort_order:mixed,title:?string,url_alias:?string,meta_title:?string,description:?string,meta_keywords:?string,meta_description:?string,image:?string,thumb:?string}|null $row */
        $row = DB::connection('tenant_ps')
            ->table($categoryTable.' as c')
            ->leftJoin($categoryLangTable.' as cl', function ($join) use ($langId): void {
                $join
                    ->on('cl.id_category', '=', 'c.id_category')
                    ->where('cl.id_lang', '=', $langId);
            })
            ->where('c.id_category', $categoryId)
            ->select([
                'c.id_category',
                'c.id_parent',
                'c.enabled',
                'c.sort_order',
                'cl.title',
                'cl.url_alias',
                'cl.meta_title',
                'cl.description',
                'cl.meta_keywords',
                'cl.meta_description',
                'cl.image',
                'cl.thumb',
            ])
            ->first();

        if ($row === null) {
            throw new RuntimeException('Blog category not found in PrestaShop database.');
        }

        return [
            'id_category' => (int) data_get($row, 'id_category', 0),
            'id_parent' => max(0, (int) data_get($row, 'id_parent', 0)),
            'enabled' => (bool) data_get($row, 'enabled', false),
            'sort_order' => max(1, (int) data_get($row, 'sort_order', 1)),
            'title' => trim((string) data_get($row, 'title', '')),
            'url_alias' => trim((string) data_get($row, 'url_alias', '')),
            'meta_title' => trim((string) data_get($row, 'meta_title', '')),
            'description' => $this->nullableString(data_get($row, 'description')),
            'meta_keywords' => trim((string) data_get($row, 'meta_keywords', '')),
            'meta_description' => $this->nullableString(data_get($row, 'meta_description')),
            'image' => $this->nullableString(data_get($row, 'image')),
            'thumb' => $this->nullableString(data_get($row, 'thumb')),
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function createCategory(array $payload): int
    {
        $this->resolveTenantId();

        $langId = $this->resolveDefaultLanguageId();

        if ($langId < 1) {
            throw new RuntimeException('Default language is missing.');
        }

        $resolvedPayload = $this->resolvePayload($payload);
        $categoryTable = $this->tenantPrestaShopConnection->table('ets_blog_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('ets_blog_category_lang');
        $now = now()->format('Y-m-d H:i:s');
        $actorId = $this->resolveActorId();

        return (int) DB::connection('tenant_ps')->transaction(function () use (
            $resolvedPayload,
            $categoryTable,
            $categoryLangTable,
            $langId,
            $now,
            $actorId
        ): int {
            $newCategoryId = (int) DB::connection('tenant_ps')
                ->table($categoryTable)
                ->insertGetId([
                    'id_shop' => $this->resolveReadShopId(),
                    'id_parent' => $resolvedPayload['id_parent'],
                    'added_by' => $actorId,
                    'modified_by' => $actorId,
                    'enabled' => (int) $resolvedPayload['enabled'],
                    'date_add' => $now,
                    'date_upd' => $now,
                    'sort_order' => $resolvedPayload['sort_order'],
                ], 'id_category');

            if ($newCategoryId < 1) {
                throw new RuntimeException('Unable to create blog category.');
            }

            DB::connection('tenant_ps')
                ->table($categoryLangTable)
                ->updateOrInsert(
                    [
                        'id_category' => $newCategoryId,
                        'id_lang' => $langId,
                    ],
                    [
                        'meta_title' => $resolvedPayload['meta_title'],
                        'title' => $resolvedPayload['title'],
                        'description' => $resolvedPayload['description'],
                        'url_alias' => $resolvedPayload['url_alias'],
                        'meta_keywords' => $resolvedPayload['meta_keywords'],
                        'meta_description' => $resolvedPayload['meta_description'],
                        'image' => $resolvedPayload['image'],
                        'thumb' => $resolvedPayload['thumb'],
                    ],
                );

            return $newCategoryId;
        });
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateCategory(int $categoryId, array $payload): void
    {
        $this->resolveTenantId();

        if ($categoryId < 1) {
            throw new RuntimeException('Blog category is required.');
        }

        $langId = $this->resolveDefaultLanguageId();

        if ($langId < 1) {
            throw new RuntimeException('Default language is missing.');
        }

        $resolvedPayload = $this->resolvePayload($payload);
        $categoryTable = $this->tenantPrestaShopConnection->table('ets_blog_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('ets_blog_category_lang');
        $now = now()->format('Y-m-d H:i:s');
        $actorId = $this->resolveActorId();

        DB::connection('tenant_ps')->transaction(function () use (
            $categoryId,
            $resolvedPayload,
            $categoryTable,
            $categoryLangTable,
            $langId,
            $now,
            $actorId
        ): void {
            $updated = DB::connection('tenant_ps')
                ->table($categoryTable)
                ->where('id_category', $categoryId)
                ->update([
                    'id_parent' => $resolvedPayload['id_parent'],
                    'modified_by' => $actorId,
                    'enabled' => (int) $resolvedPayload['enabled'],
                    'date_upd' => $now,
                    'sort_order' => $resolvedPayload['sort_order'],
                ]);

            if ($updated < 1) {
                throw new RuntimeException('Blog category not found in PrestaShop database.');
            }

            DB::connection('tenant_ps')
                ->table($categoryLangTable)
                ->updateOrInsert(
                    [
                        'id_category' => $categoryId,
                        'id_lang' => $langId,
                    ],
                    [
                        'meta_title' => $resolvedPayload['meta_title'],
                        'title' => $resolvedPayload['title'],
                        'description' => $resolvedPayload['description'],
                        'url_alias' => $resolvedPayload['url_alias'],
                        'meta_keywords' => $resolvedPayload['meta_keywords'],
                        'meta_description' => $resolvedPayload['meta_description'],
                        'image' => $resolvedPayload['image'],
                        'thumb' => $resolvedPayload['thumb'],
                    ],
                );
        });
    }

    public function deleteCategory(int $categoryId): void
    {
        $this->resolveTenantId();

        if ($categoryId < 1) {
            throw new RuntimeException('Blog category is required.');
        }

        $categoryTable = $this->tenantPrestaShopConnection->table('ets_blog_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('ets_blog_category_lang');
        $postCategoryTable = $this->tenantPrestaShopConnection->table('ets_blog_post_category');

        DB::connection('tenant_ps')->transaction(function () use ($categoryId, $categoryTable, $categoryLangTable, $postCategoryTable): void {
            DB::connection('tenant_ps')
                ->table($postCategoryTable)
                ->where('id_category', $categoryId)
                ->delete();

            DB::connection('tenant_ps')
                ->table($categoryLangTable)
                ->where('id_category', $categoryId)
                ->delete();

            $deleted = DB::connection('tenant_ps')
                ->table($categoryTable)
                ->where('id_category', $categoryId)
                ->delete();

            if ($deleted < 1) {
                throw new RuntimeException('Blog category not found in PrestaShop database.');
            }
        });
    }

    /**
     * @return array<int, string>
     */
    public function getCategoryOptions(): array
    {
        $this->resolveTenantId();

        $langId = $this->resolveDefaultLanguageId();

        if ($langId < 1) {
            return [];
        }

        $categoryTable = $this->tenantPrestaShopConnection->table('ets_blog_category');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('ets_blog_category_lang');

        /** @var array<int, string> $options */
        $options = DB::connection('tenant_ps')
            ->table($categoryTable.' as c')
            ->join($categoryLangTable.' as cl', function ($join) use ($langId): void {
                $join
                    ->on('cl.id_category', '=', 'c.id_category')
                    ->where('cl.id_lang', '=', $langId);
            })
            ->orderBy('cl.title')
            ->pluck('cl.title', 'c.id_category')
            ->mapWithKeys(fn (mixed $name, mixed $id): array => [(int) $id => (string) $name])
            ->all();

        return $options;
    }

    public function resolveDefaultLanguageId(): int
    {
        $this->resolveTenantId();

        $languageTable = $this->tenantPrestaShopConnection->table('lang');

        /** @var int|string|null $idLang */
        $idLang = DB::connection('tenant_ps')
            ->table($languageTable)
            ->orderBy('id_lang')
            ->value('id_lang');

        return max(0, (int) $idLang);
    }

    private function resolveReadShopId(): int
    {
        $shopTable = $this->tenantPrestaShopConnection->table('shop');

        /** @var int|string|null $idShop */
        $idShop = DB::connection('tenant_ps')
            ->table($shopTable)
            ->orderBy('id_shop')
            ->value('id_shop');

        return max(1, (int) $idShop);
    }

    private function resolveTenantId(): int
    {
        $tenantId = $this->tenantContext->tenantId();

        if (! is_int($tenantId) || $tenantId < 1) {
            throw new RuntimeException('Tenant context is missing.');
        }

        return $tenantId;
    }

    private function resolveActorId(): int
    {
        $tenantUserId = Auth::guard('tenant')->id();

        if (is_numeric($tenantUserId)) {
            return max(0, (int) $tenantUserId);
        }

        $webUserId = Auth::guard('web')->id();

        return is_numeric($webUserId) ? max(0, (int) $webUserId) : 0;
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array{
     *     id_parent:int,
     *     enabled:bool,
     *     sort_order:int,
     *     title:string,
     *     url_alias:string,
     *     meta_title:string,
     *     description:?string,
     *     meta_keywords:string,
     *     meta_description:?string,
     *     image:?string,
     *     thumb:?string
     * }
     */
    private function resolvePayload(array $payload): array
    {
        $title = trim((string) ($payload['title'] ?? ''));

        if ($title === '') {
            throw new RuntimeException('Blog category title is required.');
        }

        $urlAlias = trim((string) ($payload['url_alias'] ?? ''));

        return [
            'id_parent' => max(0, (int) ($payload['id_parent'] ?? 0)),
            'enabled' => (bool) ($payload['enabled'] ?? true),
            'sort_order' => max(1, (int) ($payload['sort_order'] ?? 1)),
            'title' => Str::limit($title, 2000, ''),
            'url_alias' => Str::limit($urlAlias !== '' ? Str::slug($urlAlias) : Str::slug($title), 700, ''),
            'meta_title' => Str::limit(trim((string) ($payload['meta_title'] ?? $title)), 2000, ''),
            'description' => $this->nullableString($payload['description'] ?? null),
            'meta_keywords' => Str::limit(trim((string) ($payload['meta_keywords'] ?? '')), 5000, ''),
            'meta_description' => $this->nullableString($payload['meta_description'] ?? null),
            'image' => $this->nullableString($payload['image'] ?? null),
            'thumb' => $this->nullableString($payload['thumb'] ?? null),
        ];
    }

    private function nullableString(mixed $value): ?string
    {
        if (! is_scalar($value) && $value !== null) {
            return null;
        }

        $resolvedValue = trim((string) $value);

        return $resolvedValue !== '' ? $resolvedValue : null;
    }
}
