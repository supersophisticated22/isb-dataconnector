<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class TenantPrestaShopBlogPostService
{
    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
        private TenantPrestaShopBlogCategoryService $tenantPrestaShopBlogCategoryService,
    ) {}

    /**
     * @return LengthAwarePaginator<int, object>|array<int, array<string, mixed>>
     */
    public function listPosts(int $perPage = 25): LengthAwarePaginator|array
    {
        $this->resolveTenantId();

        $langId = $this->resolveDefaultLanguageId();

        if ($langId < 1) {
            return [];
        }

        $postTable = $this->tenantPrestaShopConnection->table('ets_blog_post');
        $postLangTable = $this->tenantPrestaShopConnection->table('ets_blog_post_lang');
        $categoryLangTable = $this->tenantPrestaShopConnection->table('ets_blog_category_lang');
        $resolvedPerPage = max(1, $perPage);

        return DB::connection('tenant_ps')
            ->table($postTable.' as p')
            ->leftJoin($postLangTable.' as pl', function ($join) use ($langId): void {
                $join
                    ->on('pl.id_post', '=', 'p.id_post')
                    ->where('pl.id_lang', '=', $langId);
            })
            ->leftJoin($categoryLangTable.' as cl', function ($join) use ($langId): void {
                $join
                    ->on('cl.id_category', '=', 'p.id_category_default')
                    ->where('cl.id_lang', '=', $langId);
            })
            ->orderBy('p.sort_order')
            ->orderBy('p.id_post')
            ->select([
                'p.id_post',
                'p.id_category_default',
                'p.enabled',
                'p.is_customer',
                'p.sort_order',
                'p.date_add',
                'p.date_upd',
                'pl.title',
                'pl.url_alias',
                'cl.title as category_title',
            ])
            ->paginate($resolvedPerPage);
    }

    /**
     * @return array{
     *     id_post:int,
     *     id_category_default:int,
     *     is_customer:bool,
     *     enabled:bool,
     *     sort_order:int,
     *     title:string,
     *     url_alias:string,
     *     meta_title:string,
     *     description:?string,
     *     short_description:?string,
     *     meta_keywords:string,
     *     meta_description:?string,
     *     image:string,
     *     thumb:string,
     *     category_ids:list<int>
     * }
     */
    public function getPost(int $postId): array
    {
        $this->resolveTenantId();

        if ($postId < 1) {
            throw new RuntimeException('Blog post is required.');
        }

        $langId = $this->resolveDefaultLanguageId();

        if ($langId < 1) {
            throw new RuntimeException('Default language is missing.');
        }

        $postTable = $this->tenantPrestaShopConnection->table('ets_blog_post');
        $postLangTable = $this->tenantPrestaShopConnection->table('ets_blog_post_lang');
        $postCategoryTable = $this->tenantPrestaShopConnection->table('ets_blog_post_category');

        /** @var object{id_post:int|string,id_category_default:mixed,is_customer:mixed,enabled:mixed,sort_order:mixed,title:?string,url_alias:?string,meta_title:?string,description:?string,short_description:?string,meta_keywords:?string,meta_description:?string,image:?string,thumb:?string}|null $row */
        $row = DB::connection('tenant_ps')
            ->table($postTable.' as p')
            ->leftJoin($postLangTable.' as pl', function ($join) use ($langId): void {
                $join
                    ->on('pl.id_post', '=', 'p.id_post')
                    ->where('pl.id_lang', '=', $langId);
            })
            ->where('p.id_post', $postId)
            ->select([
                'p.id_post',
                'p.id_category_default',
                'p.is_customer',
                'p.enabled',
                'p.sort_order',
                'pl.title',
                'pl.url_alias',
                'pl.meta_title',
                'pl.description',
                'pl.short_description',
                'pl.meta_keywords',
                'pl.meta_description',
                'pl.image',
                'pl.thumb',
            ])
            ->first();

        if ($row === null) {
            throw new RuntimeException('Blog post not found in PrestaShop database.');
        }

        /** @var list<int> $categoryIds */
        $categoryIds = DB::connection('tenant_ps')
            ->table($postCategoryTable)
            ->where('id_post', $postId)
            ->orderBy('position')
            ->pluck('id_category')
            ->map(fn (mixed $value): int => (int) $value)
            ->filter(fn (int $value): bool => $value > 0)
            ->values()
            ->all();

        return [
            'id_post' => (int) data_get($row, 'id_post', 0),
            'id_category_default' => max(0, (int) data_get($row, 'id_category_default', 0)),
            'is_customer' => (bool) data_get($row, 'is_customer', false),
            'enabled' => (bool) data_get($row, 'enabled', false),
            'sort_order' => max(1, (int) data_get($row, 'sort_order', 1)),
            'title' => trim((string) data_get($row, 'title', '')),
            'url_alias' => trim((string) data_get($row, 'url_alias', '')),
            'meta_title' => trim((string) data_get($row, 'meta_title', '')),
            'description' => $this->nullableString(data_get($row, 'description')),
            'short_description' => $this->nullableString(data_get($row, 'short_description')),
            'meta_keywords' => trim((string) data_get($row, 'meta_keywords', '')),
            'meta_description' => $this->nullableString(data_get($row, 'meta_description')),
            'image' => trim((string) data_get($row, 'image', '')),
            'thumb' => trim((string) data_get($row, 'thumb', '')),
            'category_ids' => $categoryIds,
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function createPost(array $payload): int
    {
        $this->resolveTenantId();

        $langId = $this->resolveDefaultLanguageId();

        if ($langId < 1) {
            throw new RuntimeException('Default language is missing.');
        }

        $resolvedPayload = $this->resolvePayload($payload);
        $postTable = $this->tenantPrestaShopConnection->table('ets_blog_post');
        $postLangTable = $this->tenantPrestaShopConnection->table('ets_blog_post_lang');
        $now = now()->format('Y-m-d H:i:s');
        $actorId = $this->resolveActorId();

        return (int) DB::connection('tenant_ps')->transaction(function () use (
            $resolvedPayload,
            $postTable,
            $postLangTable,
            $langId,
            $now,
            $actorId
        ): int {
            $newPostId = (int) DB::connection('tenant_ps')
                ->table($postTable)
                ->insertGetId([
                    'id_shop' => $this->resolveReadShopId(),
                    'id_category_default' => $resolvedPayload['id_category_default'],
                    'added_by' => $actorId,
                    'is_customer' => (int) $resolvedPayload['is_customer'],
                    'modified_by' => $actorId,
                    'enabled' => (int) $resolvedPayload['enabled'],
                    'date_add' => $now,
                    'date_upd' => $now,
                    'sort_order' => $resolvedPayload['sort_order'],
                ], 'id_post');

            if ($newPostId < 1) {
                throw new RuntimeException('Unable to create blog post.');
            }

            DB::connection('tenant_ps')
                ->table($postLangTable)
                ->updateOrInsert(
                    [
                        'id_post' => $newPostId,
                        'id_lang' => $langId,
                    ],
                    $resolvedPayload['lang'],
                );

            $this->syncPostCategories($newPostId, $resolvedPayload['category_ids']);

            return $newPostId;
        });
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updatePost(int $postId, array $payload): void
    {
        $this->resolveTenantId();

        if ($postId < 1) {
            throw new RuntimeException('Blog post is required.');
        }

        $langId = $this->resolveDefaultLanguageId();

        if ($langId < 1) {
            throw new RuntimeException('Default language is missing.');
        }

        $resolvedPayload = $this->resolvePayload($payload);
        $postTable = $this->tenantPrestaShopConnection->table('ets_blog_post');
        $postLangTable = $this->tenantPrestaShopConnection->table('ets_blog_post_lang');
        $now = now()->format('Y-m-d H:i:s');
        $actorId = $this->resolveActorId();

        DB::connection('tenant_ps')->transaction(function () use (
            $postId,
            $resolvedPayload,
            $postTable,
            $postLangTable,
            $langId,
            $now,
            $actorId
        ): void {
            $updated = DB::connection('tenant_ps')
                ->table($postTable)
                ->where('id_post', $postId)
                ->update([
                    'id_category_default' => $resolvedPayload['id_category_default'],
                    'is_customer' => (int) $resolvedPayload['is_customer'],
                    'modified_by' => $actorId,
                    'enabled' => (int) $resolvedPayload['enabled'],
                    'date_upd' => $now,
                    'sort_order' => $resolvedPayload['sort_order'],
                ]);

            if ($updated < 1) {
                throw new RuntimeException('Blog post not found in PrestaShop database.');
            }

            DB::connection('tenant_ps')
                ->table($postLangTable)
                ->updateOrInsert(
                    [
                        'id_post' => $postId,
                        'id_lang' => $langId,
                    ],
                    $resolvedPayload['lang'],
                );

            $this->syncPostCategories($postId, $resolvedPayload['category_ids']);
        });
    }

    public function deletePost(int $postId): void
    {
        $this->resolveTenantId();

        if ($postId < 1) {
            throw new RuntimeException('Blog post is required.');
        }

        $postTable = $this->tenantPrestaShopConnection->table('ets_blog_post');
        $postLangTable = $this->tenantPrestaShopConnection->table('ets_blog_post_lang');
        $postCategoryTable = $this->tenantPrestaShopConnection->table('ets_blog_post_category');

        DB::connection('tenant_ps')->transaction(function () use ($postId, $postTable, $postLangTable, $postCategoryTable): void {
            DB::connection('tenant_ps')
                ->table($postCategoryTable)
                ->where('id_post', $postId)
                ->delete();

            DB::connection('tenant_ps')
                ->table($postLangTable)
                ->where('id_post', $postId)
                ->delete();

            $deleted = DB::connection('tenant_ps')
                ->table($postTable)
                ->where('id_post', $postId)
                ->delete();

            if ($deleted < 1) {
                throw new RuntimeException('Blog post not found in PrestaShop database.');
            }
        });
    }

    public function resolveDefaultLanguageId(): int
    {
        return $this->tenantPrestaShopBlogCategoryService->resolveDefaultLanguageId();
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
     *     id_category_default:int,
     *     is_customer:bool,
     *     enabled:bool,
     *     sort_order:int,
     *     category_ids:list<int>,
     *     lang:array{
     *         title:string,
     *         url_alias:string,
     *         meta_title:string,
     *         description:?string,
     *         short_description:?string,
     *         meta_keywords:string,
     *         meta_description:?string,
     *         thumb:string,
     *         image:string
     *     }
     * }
     */
    private function resolvePayload(array $payload): array
    {
        $title = trim((string) ($payload['title'] ?? ''));

        if ($title === '') {
            throw new RuntimeException('Blog post title is required.');
        }

        $idCategoryDefault = max(0, (int) ($payload['id_category_default'] ?? 0));

        if ($idCategoryDefault < 1) {
            throw new RuntimeException('Default blog category is required.');
        }

        /** @var list<int> $categoryIds */
        $categoryIds = collect($payload['category_ids'] ?? [])
            ->map(fn (mixed $value): int => (int) $value)
            ->filter(fn (int $value): bool => $value > 0)
            ->unique()
            ->values()
            ->all();

        if (! in_array($idCategoryDefault, $categoryIds, true)) {
            $categoryIds[] = $idCategoryDefault;
        }

        $urlAlias = trim((string) ($payload['url_alias'] ?? ''));

        return [
            'id_category_default' => $idCategoryDefault,
            'is_customer' => (bool) ($payload['is_customer'] ?? false),
            'enabled' => (bool) ($payload['enabled'] ?? true),
            'sort_order' => max(1, (int) ($payload['sort_order'] ?? 1)),
            'category_ids' => $categoryIds,
            'lang' => [
                'title' => Str::limit($title, 2000, ''),
                'url_alias' => Str::limit($urlAlias !== '' ? Str::slug($urlAlias) : Str::slug($title), 700, ''),
                'meta_title' => Str::limit(trim((string) ($payload['meta_title'] ?? $title)), 700, ''),
                'description' => $this->nullableString($payload['description'] ?? null),
                'short_description' => $this->nullableString($payload['short_description'] ?? null),
                'meta_keywords' => Str::limit(trim((string) ($payload['meta_keywords'] ?? '')), 5000, ''),
                'meta_description' => $this->nullableString($payload['meta_description'] ?? null),
                'thumb' => Str::limit(trim((string) ($payload['thumb'] ?? '')), 1000, ''),
                'image' => Str::limit(trim((string) ($payload['image'] ?? '')), 500, ''),
            ],
        ];
    }

    /**
     * @param  list<int>  $categoryIds
     */
    private function syncPostCategories(int $postId, array $categoryIds): void
    {
        $postCategoryTable = $this->tenantPrestaShopConnection->table('ets_blog_post_category');

        DB::connection('tenant_ps')
            ->table($postCategoryTable)
            ->where('id_post', $postId)
            ->delete();

        foreach ($categoryIds as $index => $categoryId) {
            DB::connection('tenant_ps')
                ->table($postCategoryTable)
                ->insert([
                    'id_post' => $postId,
                    'id_category' => $categoryId,
                    'position' => $index + 1,
                ]);
        }
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
