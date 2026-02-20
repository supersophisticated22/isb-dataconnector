<?php

use App\Models\Tenant;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopProductContentService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    Schema::connection('tenant_ps')->create('ps_product', function (Blueprint $table): void {
        $table->integer('id_product')->primary();
        $table->decimal('price', 20, 6)->default(0);
        $table->integer('id_tax_rules_group')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_product_lang', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_lang');
        $table->integer('id_shop');
        $table->string('name');
        $table->text('description_short')->nullable();
        $table->text('description')->nullable();
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->text('meta_keywords')->nullable();
        $table->string('link_rewrite', 128);
    });

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 100,
        'price' => 12.00,
        'id_tax_rules_group' => 1,
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        'id_product' => 100,
        'id_lang' => 1,
        'id_shop' => 1,
        'name' => 'Base Name',
        'description_short' => 'Base short',
        'description' => 'Base long',
        'meta_title' => 'Base title',
        'meta_description' => 'Base description',
        'meta_keywords' => 'base,keywords',
        'link_rewrite' => 'base-name',
    ]);
});

it('returns product content for a language', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    $content = app(TenantPrestaShopProductContentService::class)->getContent(100, 1);

    expect($content['name'])->toBe('Base Name')
        ->and($content['description_short'])->toBe('Base short')
        ->and($content['description'])->toBe('Base long')
        ->and($content['meta_title'])->toBe('Base title')
        ->and($content['meta_description'])->toBe('Base description')
        ->and($content['meta_keywords'])->toBe('base,keywords')
        ->and($content['link_rewrite'])->toBe('base-name');
});

it('updates existing product_lang content and normalizes slug', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    app(TenantPrestaShopProductContentService::class)->upsertContent(100, 1, [
        'name' => 'Updated Name',
        'description_short' => 'Updated short',
        'description' => 'Updated long',
        'meta_title' => 'Updated title',
        'meta_description' => 'Updated description',
        'meta_keywords' => 'one,two',
        'link_rewrite' => ' Updated Name !! ',
    ]);

    $row = DB::connection('tenant_ps')
        ->table('ps_product_lang')
        ->where('id_product', 100)
        ->where('id_lang', 1)
        ->first();

    expect(data_get($row, 'name'))->toBe('Updated Name')
        ->and(data_get($row, 'description_short'))->toBe('Updated short')
        ->and(data_get($row, 'description'))->toBe('Updated long')
        ->and(data_get($row, 'meta_title'))->toBe('Updated title')
        ->and(data_get($row, 'meta_description'))->toBe('Updated description')
        ->and(data_get($row, 'meta_keywords'))->toBe('one,two')
        ->and(data_get($row, 'link_rewrite'))->toBe('updated-name');
});

it('inserts missing language row using existing row defaults', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    app(TenantPrestaShopProductContentService::class)->upsertContent(100, 2, [
        'name' => 'English Name',
        'description_short' => 'English short',
        'description' => 'English long',
        'meta_title' => 'English title',
        'meta_description' => 'English description',
        'meta_keywords' => 'english,keywords',
        'link_rewrite' => 'English Name',
    ]);

    $row = DB::connection('tenant_ps')
        ->table('ps_product_lang')
        ->where('id_product', 100)
        ->where('id_lang', 2)
        ->first();

    expect($row)->not()->toBeNull()
        ->and((int) data_get($row, 'id_shop'))->toBe(1)
        ->and((string) data_get($row, 'name'))->toBe('English Name')
        ->and((string) data_get($row, 'link_rewrite'))->toBe('english-name');
});

it('throws when tenant context is missing', function (): void {
    app(TenantContext::class)->clear();

    $callback = fn () => app(TenantPrestaShopProductContentService::class)->upsertContent(100, 1, [
        'name' => 'Name',
        'link_rewrite' => 'name',
    ]);

    expect($callback)
        ->toThrow(RuntimeException::class, 'Tenant context is missing.');
});
