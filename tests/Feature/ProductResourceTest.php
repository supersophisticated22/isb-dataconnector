<?php

use App\Filament\App\Resources\Products\ProductResource;
use App\Models\Tenant;
use App\Models\TenantPrestaShopProduct;
use App\Models\User;
use App\Services\TenantContext;
use App\Services\TypeSenseClient;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Mockery\MockInterface;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config()->set('database.connections.tenant_ps', [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
        'foreign_key_constraints' => false,
    ]);
});

it('fails closed when tenant context is missing', function (): void {
    app(TenantContext::class)->clear();

    $query = ProductResource::getEloquentQuery();

    expect(strtolower($query->toSql()))->toContain('1 = 0');
});

it('resolves product by id without ambiguous id_product columns', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);
    $pdo = DB::connection('tenant_ps')->getPdo();

    if (method_exists($pdo, 'sqliteCreateFunction')) {
        $pdo->sqliteCreateFunction('GREATEST', fn (mixed ...$values): mixed => max(Arr::wrap($values)));
    }

    Schema::connection('tenant_ps')->create('ps_product', function (Blueprint $table): void {
        $table->integer('id_product')->primary();
        $table->integer('id_manufacturer')->default(0);
        $table->string('reference')->nullable();
        $table->boolean('active')->default(true);
        $table->decimal('price', 20, 6)->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_product_lang', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_lang')->default(1);
        $table->string('name')->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_manufacturer', function (Blueprint $table): void {
        $table->integer('id_manufacturer')->primary();
        $table->string('name')->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_stock_available', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_product_attribute')->default(0);
        $table->integer('quantity')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_specific_price', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_product_attribute')->default(0);
        $table->string('reduction_type')->nullable();
        $table->decimal('reduction', 20, 6)->default(0);
        $table->string('from')->default('0000-00-00 00:00:00');
        $table->string('to')->default('0000-00-00 00:00:00');
    });

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 19,
        'id_manufacturer' => 0,
        'reference' => 'SKU-19',
        'active' => 1,
        'price' => 12.34,
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        'id_product' => 19,
        'id_lang' => 1,
        'name' => 'Product 19',
    ]);

    $record = ProductResource::getEloquentQuery()
        ->where('id_product', 19)
        ->first();

    expect($record)->not()->toBeNull()
        ->and((int) data_get($record, 'id_product'))->toBe(19);
});

it('does not use request tenant id fallback for typesense search', function (): void {
    app(TenantContext::class)->clear();
    request()->attributes->set('tenant_id', 999);

    Http::fake();

    $query = TenantPrestaShopProduct::query()->from('ps_product as p');
    ProductResource::applyTypeSenseSearch($query, 'shoes');

    expect(strtolower($query->toSql()))->toContain('1 = 0');
    Http::assertNothingSent();
});

it('applies typesense ids when tenant context is valid', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    app()->instance(TypeSenseClient::class, mock(TypeSenseClient::class, function (MockInterface $mock) use ($tenant): void {
        $mock->shouldReceive('searchProductDocs')
            ->once()
            ->with($tenant->id, 'shoe', 1, 250)
            ->andReturn([
                'data' => [
                    ['id' => '101'],
                    ['id' => '202'],
                ],
                'total' => 2,
            ]);
    }));

    $query = TenantPrestaShopProduct::query()->from('ps_product as p');
    ProductResource::applyTypeSenseSearch($query, 'shoe');

    $sql = strtolower($query->toSql());

    expect($sql)->toContain('in')
        ->and($query->getBindings())->toContain(101, 202);
});

it('allows tenant admin to view product resource via tenant guard gate', function (): void {
    $tenant = Tenant::factory()->create();
    $user = User::factory()->create();
    $user->tenants()->attach($tenant->id, ['role' => 'admin', 'status' => 'active']);

    app(TenantContext::class)->setTenant($tenant);
    actingAs($user, 'tenant');

    expect(ProductResource::canViewAny())->toBeTrue()
        ->and(ProductResource::canView(TenantPrestaShopProduct::query()->make()))->toBeTrue();
});
