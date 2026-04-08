<?php

use App\Models\Tenant;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopBlogCategoryService;
use App\Services\TenantPrestaShopBlogPostService;
use App\Services\TenantPrestaShopBlogReplyService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config()->set('database.connections.tenant_ps', [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
        'foreign_key_constraints' => false,
    ]);

    DB::purge('tenant_ps');
    DB::reconnect('tenant_ps');

    Schema::connection('tenant_ps')->create('ps_lang', function (Blueprint $table): void {
        $table->integer('id_lang')->primary();
        $table->string('name');
        $table->string('iso_code', 8)->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_shop', function (Blueprint $table): void {
        $table->integer('id_shop')->primary();
    });

    Schema::connection('tenant_ps')->create('ps_ets_blog_category', function (Blueprint $table): void {
        $table->integer('id_category')->primary();
        $table->integer('id_shop');
        $table->integer('id_parent')->default(0);
        $table->integer('added_by')->default(0);
        $table->integer('modified_by')->default(0);
        $table->boolean('enabled')->default(true);
        $table->dateTime('date_add')->nullable();
        $table->dateTime('date_upd')->nullable();
        $table->integer('sort_order')->default(1);
    });

    Schema::connection('tenant_ps')->create('ps_ets_blog_category_lang', function (Blueprint $table): void {
        $table->integer('id_category');
        $table->integer('id_lang');
        $table->string('meta_title', 2000);
        $table->string('title', 2000);
        $table->text('description')->nullable();
        $table->string('url_alias', 700);
        $table->string('meta_keywords', 5000);
        $table->text('meta_description')->nullable();
        $table->string('image', 500)->nullable();
        $table->string('thumb', 500)->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_ets_blog_post', function (Blueprint $table): void {
        $table->integer('id_post')->primary();
        $table->integer('id_shop')->nullable();
        $table->integer('id_category_default')->nullable();
        $table->integer('added_by')->default(0);
        $table->integer('is_customer')->default(0);
        $table->integer('modified_by')->default(0);
        $table->boolean('enabled')->default(true);
        $table->dateTime('date_add')->nullable();
        $table->dateTime('date_upd')->nullable();
        $table->integer('sort_order')->default(1);
    });

    Schema::connection('tenant_ps')->create('ps_ets_blog_post_category', function (Blueprint $table): void {
        $table->integer('id_post');
        $table->integer('id_category');
        $table->integer('position')->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_ets_blog_post_lang', function (Blueprint $table): void {
        $table->integer('id_post');
        $table->integer('id_lang');
        $table->string('title', 2000);
        $table->string('url_alias', 700);
        $table->string('meta_title', 700);
        $table->text('description')->nullable();
        $table->text('short_description')->nullable();
        $table->string('meta_keywords', 5000);
        $table->text('meta_description')->nullable();
        $table->string('thumb', 1000);
        $table->string('image', 500);
    });

    Schema::connection('tenant_ps')->create('ps_ets_blog_reply', function (Blueprint $table): void {
        $table->integer('id_reply')->primary();
        $table->integer('id_comment');
        $table->integer('id_user');
        $table->string('name', 5000);
        $table->string('email', 5000);
        $table->text('reply')->nullable();
        $table->integer('id_employee')->default(0);
        $table->integer('approved')->nullable();
        $table->dateTime('date_add')->nullable();
        $table->dateTime('date_upd')->nullable();
    });

    DB::connection('tenant_ps')->table('ps_lang')->insert([
        ['id_lang' => 1, 'name' => 'Nederlands', 'iso_code' => 'nl'],
        ['id_lang' => 2, 'name' => 'English', 'iso_code' => 'en'],
    ]);

    DB::connection('tenant_ps')->table('ps_shop')->insert([
        ['id_shop' => 1],
    ]);

    DB::connection('tenant_ps')->table('ps_ets_blog_category')->insert([
        [
            'id_category' => 1,
            'id_shop' => 1,
            'id_parent' => 0,
            'added_by' => 1,
            'modified_by' => 1,
            'enabled' => 1,
            'date_add' => '2026-01-01 00:00:00',
            'date_upd' => '2026-01-01 00:00:00',
            'sort_order' => 1,
        ],
    ]);

    DB::connection('tenant_ps')->table('ps_ets_blog_category_lang')->insert([
        [
            'id_category' => 1,
            'id_lang' => 1,
            'meta_title' => 'Nieuws',
            'title' => 'Nieuws',
            'description' => 'Nieuws categorie',
            'url_alias' => 'nieuws',
            'meta_keywords' => 'nieuws',
            'meta_description' => 'Nieuws meta',
            'image' => null,
            'thumb' => null,
        ],
    ]);

    DB::connection('tenant_ps')->table('ps_ets_blog_post')->insert([
        [
            'id_post' => 10,
            'id_shop' => 1,
            'id_category_default' => 1,
            'added_by' => 1,
            'is_customer' => 0,
            'modified_by' => 1,
            'enabled' => 1,
            'date_add' => '2026-01-01 00:00:00',
            'date_upd' => '2026-01-01 00:00:00',
            'sort_order' => 1,
        ],
    ]);

    DB::connection('tenant_ps')->table('ps_ets_blog_post_lang')->insert([
        [
            'id_post' => 10,
            'id_lang' => 1,
            'title' => 'Welkom',
            'url_alias' => 'welkom',
            'meta_title' => 'Welkom',
            'description' => 'Beschrijving',
            'short_description' => 'Kort',
            'meta_keywords' => 'welkom',
            'meta_description' => 'Meta',
            'thumb' => 'thumb.jpg',
            'image' => 'image.jpg',
        ],
    ]);

    DB::connection('tenant_ps')->table('ps_ets_blog_post_category')->insert([
        [
            'id_post' => 10,
            'id_category' => 1,
            'position' => 1,
        ],
    ]);

    DB::connection('tenant_ps')->table('ps_ets_blog_reply')->insert([
        [
            'id_reply' => 100,
            'id_comment' => 77,
            'id_user' => 9,
            'name' => 'Jane',
            'email' => 'jane@example.com',
            'reply' => 'Thanks!',
            'id_employee' => 1,
            'approved' => 1,
            'date_add' => '2026-01-01 00:00:00',
            'date_upd' => '2026-01-01 00:00:00',
        ],
    ]);
});

it('lists and manages blog categories', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    $service = app(TenantPrestaShopBlogCategoryService::class);

    $list = $service->listCategories();
    $row = $service->getCategory(1);

    expect($list)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and((string) data_get($list->items()[0] ?? null, 'title'))->toBe('Nieuws')
        ->and($row['title'])->toBe('Nieuws');

    $newCategoryId = $service->createCategory([
        'id_parent' => 1,
        'enabled' => true,
        'sort_order' => 2,
        'title' => 'Updates',
        'url_alias' => 'updates',
        'meta_title' => 'Updates',
        'description' => 'Updates description',
        'meta_keywords' => 'updates',
        'meta_description' => 'Updates meta',
        'image' => null,
        'thumb' => null,
    ]);

    $service->updateCategory($newCategoryId, [
        'id_parent' => 1,
        'enabled' => false,
        'sort_order' => 5,
        'title' => 'Updates edited',
        'url_alias' => 'updates-edited',
        'meta_title' => 'Updates edited',
        'description' => 'Updated',
        'meta_keywords' => 'edited',
        'meta_description' => 'Edited meta',
        'image' => null,
        'thumb' => null,
    ]);

    $updated = $service->getCategory($newCategoryId);

    expect($updated['enabled'])->toBeFalse()
        ->and($updated['sort_order'])->toBe(5)
        ->and($updated['title'])->toBe('Updates edited');
});

it('lists and manages blog posts with category sync', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    $categoryService = app(TenantPrestaShopBlogCategoryService::class);
    $newCategoryId = $categoryService->createCategory([
        'id_parent' => 0,
        'enabled' => true,
        'sort_order' => 2,
        'title' => 'Tech',
        'url_alias' => 'tech',
        'meta_title' => 'Tech',
        'description' => null,
        'meta_keywords' => '',
        'meta_description' => null,
        'image' => null,
        'thumb' => null,
    ]);

    $service = app(TenantPrestaShopBlogPostService::class);
    $list = $service->listPosts();
    $row = $service->getPost(10);

    expect($list)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and((string) data_get($list->items()[0] ?? null, 'title'))->toBe('Welkom')
        ->and($row['title'])->toBe('Welkom')
        ->and($row['category_ids'])->toBe([1]);

    $newPostId = $service->createPost([
        'id_category_default' => 1,
        'category_ids' => [1, $newCategoryId],
        'is_customer' => false,
        'enabled' => true,
        'sort_order' => 3,
        'title' => 'New Post',
        'url_alias' => 'new-post',
        'meta_title' => 'New Post',
        'description' => 'Description',
        'short_description' => 'Short',
        'meta_keywords' => 'new',
        'meta_description' => 'Meta',
        'thumb' => 'thumb.png',
        'image' => 'image.png',
    ]);

    $service->updatePost($newPostId, [
        'id_category_default' => $newCategoryId,
        'category_ids' => [$newCategoryId],
        'is_customer' => true,
        'enabled' => false,
        'sort_order' => 8,
        'title' => 'Edited Post',
        'url_alias' => 'edited-post',
        'meta_title' => 'Edited Post',
        'description' => 'Edited description',
        'short_description' => 'Edited short',
        'meta_keywords' => 'edited',
        'meta_description' => 'Edited meta',
        'thumb' => 'edited-thumb.png',
        'image' => 'edited-image.png',
    ]);

    $updated = $service->getPost($newPostId);

    expect($updated['enabled'])->toBeFalse()
        ->and($updated['is_customer'])->toBeTrue()
        ->and($updated['id_category_default'])->toBe($newCategoryId)
        ->and($updated['category_ids'])->toBe([$newCategoryId]);
});

it('lists and manages blog replies', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    $service = app(TenantPrestaShopBlogReplyService::class);

    $list = $service->listReplies();
    $row = $service->getReply(100);

    expect($list)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and((int) data_get($list->items()[0] ?? null, 'id_reply'))->toBe(100)
        ->and($row['name'])->toBe('Jane');

    $newReplyId = $service->createReply([
        'id_comment' => 88,
        'id_user' => 12,
        'name' => 'John',
        'email' => 'john@example.com',
        'reply' => 'Interesting',
        'id_employee' => 1,
        'approved' => 0,
    ]);

    $service->updateReply($newReplyId, [
        'id_comment' => 88,
        'id_user' => 12,
        'name' => 'John Updated',
        'email' => 'john@example.com',
        'reply' => 'Updated reply',
        'id_employee' => 1,
        'approved' => 1,
    ]);

    $updated = $service->getReply($newReplyId);

    expect($updated['name'])->toBe('John Updated')
        ->and($updated['approved'])->toBe(1);
});

it('throws when tenant context is missing for blog services', function (): void {
    app(TenantContext::class)->clear();

    $callback = fn () => app(TenantPrestaShopBlogPostService::class)->createPost([
        'id_category_default' => 1,
        'category_ids' => [1],
        'title' => 'Invalid',
        'url_alias' => 'invalid',
        'meta_title' => 'Invalid',
        'thumb' => '',
        'image' => '',
    ]);

    expect($callback)->toThrow(RuntimeException::class, 'Tenant context is missing.');
});
