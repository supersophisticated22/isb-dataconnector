<?php

use App\Models\Tenant;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopProductEditorService;
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
    config()->set('prestashop.features.inhoud_id', 9);
});

it('updates product content, categories, weight and predefined inhoud value', function (): void {
    Schema::connection('tenant_ps')->create('ps_product', function (Blueprint $table): void {
        $table->integer('id_product')->primary();
        $table->integer('id_category_default')->default(0);
        $table->decimal('weight', 20, 6)->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_product_shop', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_shop')->default(1);
        $table->integer('id_category_default')->default(0);
        $table->decimal('weight', 20, 6)->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_product_lang', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_lang');
        $table->integer('id_shop')->default(1);
        $table->string('name');
        $table->text('description_short')->nullable();
        $table->text('description')->nullable();
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->text('meta_keywords')->nullable();
        $table->string('link_rewrite', 128);
    });

    Schema::connection('tenant_ps')->create('ps_lang', function (Blueprint $table): void {
        $table->integer('id_lang')->primary();
        $table->string('name');
        $table->string('iso_code', 8)->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_category', function (Blueprint $table): void {
        $table->integer('id_category')->primary();
        $table->integer('id_parent')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_category_lang', function (Blueprint $table): void {
        $table->integer('id_category');
        $table->integer('id_lang');
        $table->string('name');
    });

    Schema::connection('tenant_ps')->create('ps_category_product', function (Blueprint $table): void {
        $table->integer('id_category');
        $table->integer('id_product');
        $table->integer('position')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_feature', function (Blueprint $table): void {
        $table->integer('id_feature')->primary();
    });

    Schema::connection('tenant_ps')->create('ps_feature_lang', function (Blueprint $table): void {
        $table->integer('id_feature');
        $table->integer('id_lang');
        $table->string('name');
    });

    Schema::connection('tenant_ps')->create('ps_feature_product', function (Blueprint $table): void {
        $table->integer('id_feature');
        $table->integer('id_product');
        $table->integer('id_feature_value')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_feature_value', function (Blueprint $table): void {
        $table->increments('id_feature_value');
        $table->integer('id_feature');
        $table->boolean('custom')->default(false);
    });

    Schema::connection('tenant_ps')->create('ps_feature_value_lang', function (Blueprint $table): void {
        $table->integer('id_feature_value');
        $table->integer('id_lang');
        $table->string('value');
    });

    DB::connection('tenant_ps')->table('ps_lang')->insert([
        ['id_lang' => 1, 'name' => 'Dutch', 'iso_code' => 'nl'],
        ['id_lang' => 2, 'name' => 'English', 'iso_code' => 'en'],
    ]);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 100,
        'id_category_default' => 2,
        'weight' => 1.000000,
    ]);

    DB::connection('tenant_ps')->table('ps_product_shop')->insert([
        'id_product' => 100,
        'id_shop' => 1,
        'id_category_default' => 2,
        'weight' => 1.000000,
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        'id_product' => 100,
        'id_lang' => 1,
        'id_shop' => 1,
        'name' => 'Origineel',
        'description_short' => 'Kort',
        'description' => 'Lang',
        'meta_title' => 'Meta',
        'meta_description' => 'Beschrijving',
        'meta_keywords' => 'een,twee',
        'link_rewrite' => 'origineel',
    ]);

    DB::connection('tenant_ps')->table('ps_category')->insert([
        ['id_category' => 1, 'id_parent' => 0],
        ['id_category' => 2, 'id_parent' => 1],
        ['id_category' => 3, 'id_parent' => 2],
        ['id_category' => 4, 'id_parent' => 2],
    ]);

    DB::connection('tenant_ps')->table('ps_category_lang')->insert([
        ['id_category' => 1, 'id_lang' => 2, 'name' => 'Home'],
        ['id_category' => 2, 'id_lang' => 2, 'name' => 'Parent'],
        ['id_category' => 3, 'id_lang' => 2, 'name' => 'Keep'],
        ['id_category' => 4, 'id_lang' => 2, 'name' => 'Default'],
    ]);

    DB::connection('tenant_ps')->table('ps_category_product')->insert([
        ['id_category' => 2, 'id_product' => 100, 'position' => 0],
        ['id_category' => 3, 'id_product' => 100, 'position' => 1],
    ]);

    DB::connection('tenant_ps')->table('ps_feature')->insert([
        'id_feature' => 9,
    ]);

    DB::connection('tenant_ps')->table('ps_feature_lang')->insert([
        ['id_feature' => 9, 'id_lang' => 1, 'name' => 'inhoud'],
        ['id_feature' => 9, 'id_lang' => 2, 'name' => 'inhoud'],
    ]);

    DB::connection('tenant_ps')->table('ps_feature_value')->insert([
        'id_feature_value' => 1,
        'id_feature' => 9,
        'custom' => 0,
    ]);

    DB::connection('tenant_ps')->table('ps_feature_value_lang')->insert([
        ['id_feature_value' => 1, 'id_lang' => 1, 'value' => '250ml'],
        ['id_feature_value' => 1, 'id_lang' => 2, 'value' => '250ml'],
    ]);

    DB::connection('tenant_ps')->table('ps_feature_product')->insert([
        'id_feature' => 9,
        'id_product' => 100,
        'id_feature_value' => 1,
    ]);

    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    app(TenantPrestaShopProductEditorService::class)->updateProduct(100, 2, [
        'name' => 'Updated Product',
        'description_short' => 'Updated short',
        'description' => 'Updated description',
        'meta_title' => 'Updated title',
        'meta_description' => 'Updated meta',
        'meta_keywords' => 'updated,keywords',
        'link_rewrite' => ' Updated Product ',
        'weight' => 2.345,
        'defaultCategoryId' => 4,
        'categoryIds' => [3],
        'inhoud' => '500ml',
    ]);

    $product = DB::connection('tenant_ps')->table('ps_product')->where('id_product', 100)->first();
    $productShop = DB::connection('tenant_ps')->table('ps_product_shop')->where('id_product', 100)->first();
    $productLang = DB::connection('tenant_ps')
        ->table('ps_product_lang')
        ->where('id_product', 100)
        ->where('id_lang', 2)
        ->first();

    expect((int) data_get($product, 'id_category_default'))->toBe(4)
        ->and((float) data_get($product, 'weight'))->toBe(2.345)
        ->and((int) data_get($productShop, 'id_category_default'))->toBe(4)
        ->and((float) data_get($productShop, 'weight'))->toBe(2.345)
        ->and((string) data_get($productLang, 'name'))->toBe('Updated Product')
        ->and((int) data_get($productLang, 'id_shop'))->toBe(1)
        ->and((string) data_get($productLang, 'link_rewrite'))->toBe('updated-product');

    $categories = DB::connection('tenant_ps')
        ->table('ps_category_product')
        ->where('id_product', 100)
        ->orderBy('position')
        ->get(['id_category', 'position']);

    expect($categories->pluck('id_category')->map(fn (mixed $id): int => (int) $id)->all())->toBe([3, 4])
        ->and((int) data_get($categories->firstWhere('id_category', 3), 'position'))->toBe(1);

    $featureProduct = DB::connection('tenant_ps')
        ->table('ps_feature_product')
        ->where('id_product', 100)
        ->where('id_feature', 9)
        ->first();
    $featureValueId = (int) data_get($featureProduct, 'id_feature_value');

    expect($featureValueId)->toBeGreaterThan(1);

    $featureValueLabels = DB::connection('tenant_ps')
        ->table('ps_feature_value_lang')
        ->where('id_feature_value', $featureValueId)
        ->orderBy('id_lang')
        ->pluck('value')
        ->all();

    expect($featureValueLabels)->toBe(['500ml', '500ml']);
});

it('updates inhoud using custom_value when existing row is custom', function (): void {
    Schema::connection('tenant_ps')->create('ps_product', function (Blueprint $table): void {
        $table->integer('id_product')->primary();
        $table->integer('id_category_default')->default(0);
        $table->decimal('weight', 20, 6)->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_product_lang', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_lang');
        $table->integer('id_shop')->default(1);
        $table->string('name');
        $table->text('description_short')->nullable();
        $table->text('description')->nullable();
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->text('meta_keywords')->nullable();
        $table->string('link_rewrite', 128);
    });

    Schema::connection('tenant_ps')->create('ps_category_product', function (Blueprint $table): void {
        $table->integer('id_category');
        $table->integer('id_product');
        $table->integer('position')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_feature', function (Blueprint $table): void {
        $table->integer('id_feature')->primary();
    });

    Schema::connection('tenant_ps')->create('ps_feature_lang', function (Blueprint $table): void {
        $table->integer('id_feature');
        $table->integer('id_lang');
        $table->string('name');
    });

    Schema::connection('tenant_ps')->create('ps_feature_product', function (Blueprint $table): void {
        $table->integer('id_feature');
        $table->integer('id_product');
        $table->integer('id_feature_value')->default(0);
        $table->string('custom_value')->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_feature_value', function (Blueprint $table): void {
        $table->increments('id_feature_value');
        $table->integer('id_feature');
        $table->boolean('custom')->default(false);
    });

    Schema::connection('tenant_ps')->create('ps_feature_value_lang', function (Blueprint $table): void {
        $table->integer('id_feature_value');
        $table->integer('id_lang');
        $table->string('value');
    });

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 100,
        'id_category_default' => 2,
        'weight' => 1.000000,
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        'id_product' => 100,
        'id_lang' => 1,
        'id_shop' => 1,
        'name' => 'Origineel',
        'description_short' => 'Kort',
        'description' => 'Lang',
        'meta_title' => 'Meta',
        'meta_description' => 'Beschrijving',
        'meta_keywords' => 'een,twee',
        'link_rewrite' => 'origineel',
    ]);

    DB::connection('tenant_ps')->table('ps_category_product')->insert([
        ['id_category' => 2, 'id_product' => 100, 'position' => 0],
    ]);

    DB::connection('tenant_ps')->table('ps_feature')->insert([
        'id_feature' => 9,
    ]);

    DB::connection('tenant_ps')->table('ps_feature_lang')->insert([
        ['id_feature' => 9, 'id_lang' => 1, 'name' => 'inhoud'],
    ]);

    DB::connection('tenant_ps')->table('ps_feature_product')->insert([
        'id_feature' => 9,
        'id_product' => 100,
        'id_feature_value' => 0,
        'custom_value' => 'Old value',
    ]);

    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    app(TenantPrestaShopProductEditorService::class)->updateProduct(100, 1, [
        'name' => 'Updated Product',
        'description_short' => 'Updated short',
        'description' => 'Updated description',
        'meta_title' => 'Updated title',
        'meta_description' => 'Updated meta',
        'meta_keywords' => 'updated,keywords',
        'link_rewrite' => 'Updated Product',
        'weight' => 2,
        'defaultCategoryId' => 2,
        'categoryIds' => [2],
        'inhoud' => 'Custom value',
    ]);

    $featureProduct = DB::connection('tenant_ps')
        ->table('ps_feature_product')
        ->where('id_product', 100)
        ->where('id_feature', 9)
        ->first();

    expect((int) data_get($featureProduct, 'id_feature_value'))->toBe(0)
        ->and((string) data_get($featureProduct, 'custom_value'))->toBe('Custom value')
        ->and(DB::connection('tenant_ps')->table('ps_feature_value')->count())->toBe(0);
});
