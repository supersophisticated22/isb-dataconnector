<?php

use App\Models\Tenant;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopCmsCategoryService;
use App\Services\TenantPrestaShopCmsPageService;
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

    Schema::connection('tenant_ps')->create('ps_cms_category', function (Blueprint $table): void {
        $table->integer('id_cms_category')->primary();
        $table->integer('id_parent')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_cms_category_lang', function (Blueprint $table): void {
        $table->integer('id_cms_category');
        $table->integer('id_lang');
        $table->string('name');
    });

    Schema::connection('tenant_ps')->create('ps_cms', function (Blueprint $table): void {
        $table->integer('id_cms')->primary();
        $table->integer('id_cms_category');
        $table->boolean('active')->default(false);
        $table->integer('position')->nullable();
        $table->boolean('indexation')->default(true);
    });

    Schema::connection('tenant_ps')->create('ps_cms_lang', function (Blueprint $table): void {
        $table->integer('id_cms');
        $table->integer('id_lang');
        $table->integer('id_shop');
        $table->string('meta_title');
        $table->text('meta_description')->nullable();
        $table->text('meta_keywords')->nullable();
        $table->string('link_rewrite', 128);
        $table->text('content')->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_cms_shop', function (Blueprint $table): void {
        $table->integer('id_cms');
        $table->integer('id_shop');
    });

    DB::connection('tenant_ps')->table('ps_lang')->insert([
        ['id_lang' => 1, 'name' => 'Nederlands', 'iso_code' => 'nl'],
        ['id_lang' => 2, 'name' => 'English', 'iso_code' => 'en'],
    ]);

    DB::connection('tenant_ps')->table('ps_shop')->insert([
        ['id_shop' => 1],
        ['id_shop' => 2],
    ]);

    DB::connection('tenant_ps')->table('ps_cms_category')->insert([
        ['id_cms_category' => 1, 'id_parent' => 0],
        ['id_cms_category' => 2, 'id_parent' => 1],
    ]);

    DB::connection('tenant_ps')->table('ps_cms_category_lang')->insert([
        ['id_cms_category' => 1, 'id_lang' => 1, 'name' => 'Root'],
        ['id_cms_category' => 2, 'id_lang' => 1, 'name' => 'Nieuws'],
        ['id_cms_category' => 1, 'id_lang' => 2, 'name' => 'Root'],
        ['id_cms_category' => 2, 'id_lang' => 2, 'name' => 'News'],
    ]);

    DB::connection('tenant_ps')->table('ps_cms')->insert([
        'id_cms' => 100,
        'id_cms_category' => 2,
        'active' => 1,
        'position' => 3,
        'indexation' => 1,
    ]);

    DB::connection('tenant_ps')->table('ps_cms_shop')->insert([
        ['id_cms' => 100, 'id_shop' => 1],
    ]);

    DB::connection('tenant_ps')->table('ps_cms_lang')->insert([
        'id_cms' => 100,
        'id_lang' => 1,
        'id_shop' => 1,
        'meta_title' => 'Welkom',
        'meta_description' => 'Beschrijving',
        'meta_keywords' => 'welkom,home',
        'link_rewrite' => 'welkom',
        'content' => '<p>Inhoud</p>',
    ]);
});

it('returns localized CMS category options with tree labels', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    $options = app(TenantPrestaShopCmsCategoryService::class)->getCategoryOptions(1);

    expect($options)->toMatchArray([
        1 => 'Root',
        2 => 'Root > Nieuws',
    ]);
});

it('lists and fetches a cms page in the selected language', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    $service = app(TenantPrestaShopCmsPageService::class);

    $pages = $service->listPages(1);
    $page = $service->getPage(100, 1);

    expect($pages)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and((string) data_get($pages->items()[0] ?? null, 'meta_title'))->toBe('Welkom')
        ->and((string) data_get($pages->items()[0] ?? null, 'category_name'))->toBe('Nieuws')
        ->and($page['meta_title'])->toBe('Welkom')
        ->and($page['category_label'])->toBe('Nieuws')
        ->and($page['shop_ids'])->toBe([1]);
});

it('creates a cms page and associates cms_lang and cms_shop rows', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    $cmsId = app(TenantPrestaShopCmsPageService::class)->upsertPage(2, [
        'id_cms_category' => 2,
        'active' => true,
        'position' => 9,
        'indexation' => false,
        'meta_title' => 'About us',
        'meta_description' => 'About page',
        'meta_keywords' => 'about,company',
        'link_rewrite' => 'About Us!',
        'content' => '<p>About</p>',
        'shop_ids' => [1, 2],
    ]);

    $cmsRow = DB::connection('tenant_ps')
        ->table('ps_cms')
        ->where('id_cms', $cmsId)
        ->first();

    $cmsLangRows = DB::connection('tenant_ps')
        ->table('ps_cms_lang')
        ->where('id_cms', $cmsId)
        ->where('id_lang', 2)
        ->orderBy('id_shop')
        ->get();

    $cmsShopRows = DB::connection('tenant_ps')
        ->table('ps_cms_shop')
        ->where('id_cms', $cmsId)
        ->orderBy('id_shop')
        ->pluck('id_shop')
        ->map(fn (mixed $value): int => (int) $value)
        ->all();

    expect($cmsRow)->not()->toBeNull()
        ->and((int) data_get($cmsRow, 'id_cms_category'))->toBe(2)
        ->and((int) data_get($cmsRow, 'active'))->toBe(1)
        ->and((int) data_get($cmsRow, 'position'))->toBe(9)
        ->and((int) data_get($cmsRow, 'indexation'))->toBe(0)
        ->and($cmsLangRows)->toHaveCount(2)
        ->and((string) data_get($cmsLangRows[0], 'link_rewrite'))->toBe('about-us')
        ->and((string) data_get($cmsLangRows[1], 'link_rewrite'))->toBe('about-us')
        ->and($cmsShopRows)->toBe([1, 2]);
});

it('upserts cms_lang when changing language for an existing page', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    app(TenantPrestaShopCmsPageService::class)->updatePageLanguage(100, 2, [
        'meta_title' => 'Welcome',
        'meta_description' => 'Description',
        'meta_keywords' => 'welcome,home',
        'link_rewrite' => 'Welcome!!',
        'content' => '<p>English</p>',
    ]);

    $row = DB::connection('tenant_ps')
        ->table('ps_cms_lang')
        ->where('id_cms', 100)
        ->where('id_lang', 2)
        ->where('id_shop', 1)
        ->first();

    expect($row)->not()->toBeNull()
        ->and((string) data_get($row, 'meta_title'))->toBe('Welcome')
        ->and((string) data_get($row, 'link_rewrite'))->toBe('welcome');
});

it('throws when tenant context is missing', function (): void {
    app(TenantContext::class)->clear();

    $callback = fn () => app(TenantPrestaShopCmsPageService::class)->upsertPage(1, [
        'id_cms_category' => 2,
        'active' => true,
        'meta_title' => 'Invalid',
        'link_rewrite' => 'invalid',
    ]);

    expect($callback)->toThrow(RuntimeException::class, 'Tenant context is missing.');
});

it('reorders cms pages using position', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    DB::connection('tenant_ps')->table('ps_cms')->insert([
        'id_cms' => 101,
        'id_cms_category' => 2,
        'active' => 1,
        'position' => 8,
        'indexation' => 1,
    ]);

    app(TenantPrestaShopCmsPageService::class)->reorderPages([101, 100]);

    $positions = DB::connection('tenant_ps')
        ->table('ps_cms')
        ->whereIn('id_cms', [100, 101])
        ->orderBy('id_cms')
        ->pluck('position', 'id_cms')
        ->mapWithKeys(fn (mixed $position, mixed $id): array => [(int) $id => (int) $position])
        ->all();

    expect($positions)->toBe([
        100 => 2,
        101 => 1,
    ]);
});
