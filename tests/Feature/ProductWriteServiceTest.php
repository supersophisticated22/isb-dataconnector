<?php

use App\Models\AuditLog;
use App\Models\Tenant;
use App\Services\ProductWriteService;
use App\Services\TenantContext;
use App\Services\TypeSenseClient;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Mockery\MockInterface;

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
        $table->integer('id_manufacturer')->default(0);
        $table->string('reference')->nullable();
        $table->boolean('active')->default(true);
        $table->decimal('price', 20, 6);
        $table->integer('id_tax_rules_group')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_stock_available', function (Blueprint $table): void {
        $table->integer('id_stock_available')->primary();
        $table->integer('id_product');
        $table->integer('id_product_attribute')->default(0);
        $table->integer('quantity')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_product_lang', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_lang');
        $table->string('name');
    });

    Schema::connection('tenant_ps')->create('ps_manufacturer', function (Blueprint $table): void {
        $table->integer('id_manufacturer')->primary();
        $table->string('name');
    });

    Schema::connection('tenant_ps')->create('ps_category_product', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_category');
    });

    Schema::connection('tenant_ps')->create('ps_specific_price', function (Blueprint $table): void {
        $table->integer('id_specific_price')->primary();
        $table->integer('id_product');
        $table->integer('id_product_attribute')->default(0);
        $table->decimal('price', 20, 6)->default(-1);
        $table->decimal('reduction', 20, 6)->default(0);
        $table->string('reduction_type')->default('amount');
        $table->dateTime('from');
        $table->dateTime('to');
    });

    Schema::connection('tenant_ps')->create('ps_country', function (Blueprint $table): void {
        $table->integer('id_country')->primary();
        $table->string('iso_code', 2);
    });

    Schema::connection('tenant_ps')->create('ps_tax', function (Blueprint $table): void {
        $table->integer('id_tax')->primary();
        $table->decimal('rate', 10, 4);
        $table->boolean('active')->default(true);
    });

    Schema::connection('tenant_ps')->create('ps_tax_rule', function (Blueprint $table): void {
        $table->integer('id_tax_rule')->primary();
        $table->integer('id_tax_rules_group');
        $table->integer('id_country')->default(0);
        $table->integer('id_tax');
    });
});

it('updates product stock inside a transaction and upserts typesense after commit', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 10,
        'id_manufacturer' => 5,
        'reference' => 'SKU-10',
        'active' => 1,
        'price' => 100.00,
        'id_tax_rules_group' => 1,
    ]);

    DB::connection('tenant_ps')->table('ps_stock_available')->insert([
        'id_stock_available' => 1,
        'id_product' => 10,
        'id_product_attribute' => 0,
        'quantity' => 4,
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        'id_product' => 10,
        'id_lang' => 1,
        'name' => 'Test Product',
    ]);

    DB::connection('tenant_ps')->table('ps_manufacturer')->insert([
        'id_manufacturer' => 5,
        'name' => 'Acme',
    ]);

    DB::connection('tenant_ps')->table('ps_category_product')->insert([
        'id_product' => 10,
        'id_category' => 2,
    ]);

    seedTaxTables();

    app()->instance(TypeSenseClient::class, mock(TypeSenseClient::class, function (MockInterface $mock) use ($tenant): void {
        $mock->shouldReceive('ensureCollectionExists')
            ->once()
            ->with($tenant->id);

        $mock->shouldReceive('upsertProductDoc')
            ->once()
            ->withArgs(function (int $tenantId, array $document) use ($tenant): bool {
                return $tenantId === $tenant->id
                    && ($document['id'] ?? null) === '10'
                    && ($document['current_price_tax_excl'] ?? null) === 100.0;
            });
    }));

    app(ProductWriteService::class)->updateProductStock(10, 15);

    expect((int) DB::connection('tenant_ps')
        ->table('ps_stock_available')
        ->where('id_product', 10)
        ->value('quantity'))
        ->toBe(15);

    expect(AuditLog::query()
        ->where('tenant_id', $tenant->id)
        ->where('action', 'product.stock.updated')
        ->where('entity_id', '10')
        ->exists())
        ->toBeTrue();
});

it('updates product base price and writes audit after post-commit sync', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 11,
        'id_manufacturer' => 6,
        'reference' => 'SKU-11',
        'active' => 1,
        'price' => 40.00,
        'id_tax_rules_group' => 1,
    ]);

    DB::connection('tenant_ps')->table('ps_stock_available')->insert([
        'id_stock_available' => 2,
        'id_product' => 11,
        'id_product_attribute' => 0,
        'quantity' => 9,
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        'id_product' => 11,
        'id_lang' => 1,
        'name' => 'Price Product',
    ]);

    DB::connection('tenant_ps')->table('ps_manufacturer')->insert([
        'id_manufacturer' => 6,
        'name' => 'Beta',
    ]);

    DB::connection('tenant_ps')->table('ps_category_product')->insert([
        'id_product' => 11,
        'id_category' => 3,
    ]);

    seedTaxTables();

    app()->instance(TypeSenseClient::class, mock(TypeSenseClient::class, function (MockInterface $mock) use ($tenant): void {
        $mock->shouldReceive('ensureCollectionExists')
            ->once()
            ->with($tenant->id);

        $mock->shouldReceive('upsertProductDoc')
            ->once()
            ->withArgs(function (int $tenantId, array $document) use ($tenant): bool {
                return $tenantId === $tenant->id
                    && ($document['id'] ?? null) === '11'
                    && ($document['original_price_tax_excl'] ?? null) === 60.0;
            });
    }));

    app(ProductWriteService::class)->updateProductBasePrice(11, 60.00);

    expect((float) DB::connection('tenant_ps')
        ->table('ps_product')
        ->where('id_product', 11)
        ->value('price'))
        ->toBe(60.0);

    $auditLog = AuditLog::query()
        ->where('tenant_id', $tenant->id)
        ->where('action', 'product.base_price.updated')
        ->where('entity_id', '11')
        ->first();

    expect($auditLog)->not->toBeNull()
        ->and((float) ($auditLog?->payload['before']['base_price_tax_excl'] ?? 0))->toBe(40.0)
        ->and((float) ($auditLog?->payload['after']['base_price_tax_excl'] ?? 0))->toBe(60.0);
});

it('creates a product specific price and writes audit after post-commit sync', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 12,
        'id_manufacturer' => 7,
        'reference' => 'SKU-12',
        'active' => 1,
        'price' => 100.00,
        'id_tax_rules_group' => 1,
    ]);

    DB::connection('tenant_ps')->table('ps_stock_available')->insert([
        'id_stock_available' => 3,
        'id_product' => 12,
        'id_product_attribute' => 0,
        'quantity' => 5,
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        'id_product' => 12,
        'id_lang' => 1,
        'name' => 'Specific Price Product',
    ]);

    DB::connection('tenant_ps')->table('ps_manufacturer')->insert([
        'id_manufacturer' => 7,
        'name' => 'Gamma',
    ]);

    DB::connection('tenant_ps')->table('ps_category_product')->insert([
        'id_product' => 12,
        'id_category' => 4,
    ]);

    seedTaxTables();

    app()->instance(TypeSenseClient::class, mock(TypeSenseClient::class, function (MockInterface $mock) use ($tenant): void {
        $mock->shouldReceive('ensureCollectionExists')
            ->once()
            ->with($tenant->id);

        $mock->shouldReceive('upsertProductDoc')
            ->once()
            ->withArgs(function (int $tenantId, array $document) use ($tenant): bool {
                return $tenantId === $tenant->id
                    && ($document['id'] ?? null) === '12'
                    && ($document['current_price_tax_excl'] ?? null) === 95.0;
            });
    }));

    app(ProductWriteService::class)->createProductSpecificPrice(12, [
        'price' => -1,
        'reduction' => 5,
        'reduction_type' => 'amount',
        'from' => now()->subHour()->format('Y-m-d H:i:s'),
        'to' => now()->addHour()->format('Y-m-d H:i:s'),
    ]);

    $specificPrice = DB::connection('tenant_ps')
        ->table('ps_specific_price')
        ->where('id_product', 12)
        ->first();

    expect($specificPrice)->not->toBeNull()
        ->and((int) ($specificPrice?->id_product_attribute ?? -1))->toBe(0)
        ->and((float) ($specificPrice?->reduction ?? 0))->toBe(5.0);

    $auditLog = AuditLog::query()
        ->where('tenant_id', $tenant->id)
        ->where('action', 'product.specific_price.created')
        ->where('entity_id', '12')
        ->first();

    expect($auditLog)->not->toBeNull()
        ->and((float) ($auditLog?->payload['after']['reduction'] ?? 0))->toBe(5.0);
});

it('updates a product specific price and writes audit after post-commit sync', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 13,
        'id_manufacturer' => 8,
        'reference' => 'SKU-13',
        'active' => 1,
        'price' => 100.00,
        'id_tax_rules_group' => 1,
    ]);

    DB::connection('tenant_ps')->table('ps_stock_available')->insert([
        'id_stock_available' => 4,
        'id_product' => 13,
        'id_product_attribute' => 0,
        'quantity' => 5,
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        'id_product' => 13,
        'id_lang' => 1,
        'name' => 'Specific Price Update Product',
    ]);

    DB::connection('tenant_ps')->table('ps_manufacturer')->insert([
        'id_manufacturer' => 8,
        'name' => 'Delta',
    ]);

    DB::connection('tenant_ps')->table('ps_category_product')->insert([
        'id_product' => 13,
        'id_category' => 5,
    ]);

    DB::connection('tenant_ps')->table('ps_specific_price')->insert([
        'id_specific_price' => 1,
        'id_product' => 13,
        'id_product_attribute' => 0,
        'price' => -1,
        'reduction' => 5,
        'reduction_type' => 'amount',
        'from' => now()->subHour()->format('Y-m-d H:i:s'),
        'to' => now()->addHour()->format('Y-m-d H:i:s'),
    ]);

    seedTaxTables();

    app()->instance(TypeSenseClient::class, mock(TypeSenseClient::class, function (MockInterface $mock) use ($tenant): void {
        $mock->shouldReceive('ensureCollectionExists')
            ->once()
            ->with($tenant->id);

        $mock->shouldReceive('upsertProductDoc')
            ->once()
            ->withArgs(function (int $tenantId, array $document) use ($tenant): bool {
                return $tenantId === $tenant->id
                    && ($document['id'] ?? null) === '13'
                    && ($document['current_price_tax_excl'] ?? null) === 80.0;
            });
    }));

    app(ProductWriteService::class)->updateProductSpecificPrice(13, 1, [
        'price' => -1,
        'reduction' => 0.20,
        'reduction_type' => 'percentage',
        'from' => now()->subHour()->format('Y-m-d H:i:s'),
        'to' => now()->addHour()->format('Y-m-d H:i:s'),
    ]);

    $specificPrice = DB::connection('tenant_ps')
        ->table('ps_specific_price')
        ->where('id_specific_price', 1)
        ->first();

    expect($specificPrice)->not->toBeNull()
        ->and((string) ($specificPrice?->reduction_type ?? ''))->toBe('percentage')
        ->and((float) ($specificPrice?->reduction ?? 0))->toBe(0.2);

    $auditLog = AuditLog::query()
        ->where('tenant_id', $tenant->id)
        ->where('action', 'product.specific_price.updated')
        ->where('entity_id', '13')
        ->first();

    expect($auditLog)->not->toBeNull()
        ->and((float) ($auditLog?->payload['before']['reduction'] ?? 0))->toBe(5.0)
        ->and((float) ($auditLog?->payload['after']['reduction'] ?? 0))->toBe(0.2);
});

it('deletes a product specific price and writes audit after post-commit sync', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 14,
        'id_manufacturer' => 9,
        'reference' => 'SKU-14',
        'active' => 1,
        'price' => 100.00,
        'id_tax_rules_group' => 1,
    ]);

    DB::connection('tenant_ps')->table('ps_stock_available')->insert([
        'id_stock_available' => 5,
        'id_product' => 14,
        'id_product_attribute' => 0,
        'quantity' => 8,
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        'id_product' => 14,
        'id_lang' => 1,
        'name' => 'Specific Price Delete Product',
    ]);

    DB::connection('tenant_ps')->table('ps_manufacturer')->insert([
        'id_manufacturer' => 9,
        'name' => 'Epsilon',
    ]);

    DB::connection('tenant_ps')->table('ps_category_product')->insert([
        'id_product' => 14,
        'id_category' => 6,
    ]);

    DB::connection('tenant_ps')->table('ps_specific_price')->insert([
        'id_specific_price' => 1,
        'id_product' => 14,
        'id_product_attribute' => 0,
        'price' => -1,
        'reduction' => 10,
        'reduction_type' => 'amount',
        'from' => now()->subHour()->format('Y-m-d H:i:s'),
        'to' => now()->addHour()->format('Y-m-d H:i:s'),
    ]);

    seedTaxTables();

    app()->instance(TypeSenseClient::class, mock(TypeSenseClient::class, function (MockInterface $mock) use ($tenant): void {
        $mock->shouldReceive('ensureCollectionExists')
            ->once()
            ->with($tenant->id);

        $mock->shouldReceive('upsertProductDoc')
            ->once()
            ->withArgs(function (int $tenantId, array $document) use ($tenant): bool {
                return $tenantId === $tenant->id
                    && ($document['id'] ?? null) === '14'
                    && ($document['current_price_tax_excl'] ?? null) === 100.0;
            });
    }));

    app(ProductWriteService::class)->deleteProductSpecificPrice(14, 1);

    expect(DB::connection('tenant_ps')
        ->table('ps_specific_price')
        ->where('id_specific_price', 1)
        ->exists())
        ->toBeFalse();

    $auditLog = AuditLog::query()
        ->where('tenant_id', $tenant->id)
        ->where('action', 'product.specific_price.deleted')
        ->where('entity_id', '14')
        ->first();

    expect($auditLog)->not->toBeNull()
        ->and((float) ($auditLog?->payload['before']['reduction'] ?? 0))->toBe(10.0);
});

it('rejects specific price update when row is out of v1 scope', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 15,
        'id_manufacturer' => 10,
        'reference' => 'SKU-15',
        'active' => 1,
        'price' => 100.00,
        'id_tax_rules_group' => 1,
    ]);

    DB::connection('tenant_ps')->table('ps_specific_price')->insert([
        'id_specific_price' => 1,
        'id_product' => 15,
        'id_product_attribute' => 1,
        'price' => -1,
        'reduction' => 5,
        'reduction_type' => 'amount',
        'from' => now()->subHour()->format('Y-m-d H:i:s'),
        'to' => now()->addHour()->format('Y-m-d H:i:s'),
    ]);

    app()->instance(TypeSenseClient::class, mock(TypeSenseClient::class, function (MockInterface $mock): void {
        $mock->shouldNotReceive('ensureCollectionExists');
        $mock->shouldNotReceive('upsertProductDoc');
    }));

    expect(fn () => app(ProductWriteService::class)->updateProductSpecificPrice(15, 1, [
        'price' => -1,
        'reduction' => 2,
        'reduction_type' => 'amount',
        'from' => now()->subHour()->format('Y-m-d H:i:s'),
        'to' => now()->addHour()->format('Y-m-d H:i:s'),
    ]))
        ->toThrow(RuntimeException::class, __('saas.resources.products.relation_managers.specific_prices.errors.not_found_or_out_of_scope'));

    expect(AuditLog::query()->count())->toBe(0);
});

it('rolls back and does not sync when product does not exist', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    app()->instance(TypeSenseClient::class, mock(TypeSenseClient::class, function (MockInterface $mock): void {
        $mock->shouldNotReceive('ensureCollectionExists');
        $mock->shouldNotReceive('upsertProductDoc');
    }));

    expect(fn () => app(ProductWriteService::class)->updateProductBasePrice(999, 10.0))
        ->toThrow(RuntimeException::class, 'Product not found in PrestaShop database.');

    expect(AuditLog::query()->count())->toBe(0);
});

function seedTaxTables(): void
{
    DB::connection('tenant_ps')->table('ps_country')->insert([
        'id_country' => 99,
        'iso_code' => 'NL',
    ]);

    DB::connection('tenant_ps')->table('ps_tax')->insert([
        'id_tax' => 1,
        'rate' => 21.0,
        'active' => 1,
    ]);

    DB::connection('tenant_ps')->table('ps_tax_rule')->insert([
        'id_tax_rule' => 1,
        'id_tax_rules_group' => 1,
        'id_country' => 99,
        'id_tax' => 1,
    ]);
}
