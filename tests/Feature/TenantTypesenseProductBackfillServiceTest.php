<?php

use App\Models\Tenant;
use App\Services\PricingService;
use App\Services\TenantPrestaShopConnection;
use App\Services\TenantTypesenseProductBackfillService;
use App\Services\TypeSenseClient;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
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
        $table->dateTime('date_upd')->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_product_lang', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_lang');
        $table->string('name');
    });

    Schema::connection('tenant_ps')->create('ps_manufacturer', function (Blueprint $table): void {
        $table->integer('id_manufacturer')->primary();
        $table->string('name')->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_category_product', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_category');
    });
});

it('upserts active tenant products and removes stale and inactive typesense docs', function (): void {
    $tenant = Tenant::factory()->create();

    DB::connection('tenant_ps')->table('ps_manufacturer')->insert([
        ['id_manufacturer' => 1, 'name' => 'Acme'],
        ['id_manufacturer' => 2, 'name' => 'Globex'],
    ]);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        ['id_product' => 1, 'id_manufacturer' => 1, 'reference' => 'SKU-1', 'active' => 1],
        ['id_product' => 2, 'id_manufacturer' => 1, 'reference' => 'SKU-2', 'active' => 0],
        ['id_product' => 3, 'id_manufacturer' => 2, 'reference' => 'SKU-3', 'active' => 1],
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        ['id_product' => 1, 'id_lang' => 1, 'name' => 'Red Shoe'],
        ['id_product' => 3, 'id_lang' => 1, 'name' => 'Blue Hat'],
    ]);

    DB::connection('tenant_ps')->table('ps_category_product')->insert([
        ['id_product' => 1, 'id_category' => 10],
        ['id_product' => 1, 'id_category' => 11],
        ['id_product' => 3, 'id_category' => 20],
    ]);

    app()->instance(TenantPrestaShopConnection::class, mock(TenantPrestaShopConnection::class, function (MockInterface $mock) use ($tenant): void {
        $mock->shouldReceive('connect')
            ->once()
            ->with(Mockery::on(static fn (mixed $resolvedTenant): bool => $resolvedTenant instanceof Tenant && $resolvedTenant->id === $tenant->id))
            ->andReturn(true);

        $mock->shouldReceive('table')
            ->andReturnUsing(static fn (string $table): string => 'ps_'.$table);
    }));

    app()->instance(PricingService::class, mock(PricingService::class, function (MockInterface $mock): void {
        $mock->shouldReceive('computeForProduct')
            ->twice()
            ->withArgs(fn (int $productId): bool => in_array($productId, [1, 3], true))
            ->andReturnUsing(static function (int $productId): array {
                return [
                    'original_price_tax_excl' => $productId === 1 ? 100.0 : 80.0,
                    'current_price_tax_excl' => $productId === 1 ? 90.0 : 80.0,
                    'original_price_tax_incl' => $productId === 1 ? 121.0 : 96.8,
                    'current_price_tax_incl' => $productId === 1 ? 108.9 : 96.8,
                    'discount_amount_tax_excl' => $productId === 1 ? 10.0 : 0.0,
                    'discount_percent' => $productId === 1 ? 10.0 : 0.0,
                ];
            });
    }));

    $upsertedIds = [];
    $deletedIds = [];

    app()->instance(TypeSenseClient::class, mock(TypeSenseClient::class, function (MockInterface $mock) use ($tenant, &$upsertedIds, &$deletedIds): void {
        $mock->shouldReceive('ensureCollectionExists')
            ->once()
            ->with($tenant->id);

        $mock->shouldReceive('listProductDocIds')
            ->once()
            ->with($tenant->id)
            ->andReturn(['1', '2', '9']);

        $mock->shouldReceive('upsertProductDoc')
            ->twice()
            ->withArgs(function (int $tenantId, array $document) use ($tenant, &$upsertedIds): bool {
                $upsertedIds[] = (string) ($document['id'] ?? '');

                return $tenantId === $tenant->id
                    && in_array((string) ($document['id'] ?? ''), ['1', '3'], true)
                    && is_string($document['name'] ?? null)
                    && is_array($document['category_ids'] ?? null)
                    && array_key_exists('current_price_tax_excl', $document);
            });

        $mock->shouldReceive('deleteProductDoc')
            ->twice()
            ->withArgs(function (int $tenantId, int|string $documentId) use ($tenant, &$deletedIds): bool {
                $deletedIds[] = (string) $documentId;

                return $tenantId === $tenant->id
                    && in_array((string) $documentId, ['2', '9'], true);
            });
    }));

    $result = app(TenantTypesenseProductBackfillService::class)->reindexTenant($tenant->id, 2);

    expect($result)->toMatchArray([
        'processed' => 3,
        'upserted' => 2,
        'failed' => 0,
        'deleted' => 2,
        'stale_deleted' => 2,
        'inactive_deleted' => 1,
    ]);

    expect($upsertedIds)->toBe(['1', '3'])
        ->and($deletedIds)->toBe(['2', '9']);
});

it('reindexes incrementally from date_upd watermark and removes changed inactive docs', function (): void {
    $tenant = Tenant::factory()->create();
    $watermarkKey = "typesense:tenant:{$tenant->id}:last_date_upd_sync";
    Cache::forever($watermarkKey, '2026-01-01 00:00:00');

    DB::connection('tenant_ps')->table('ps_manufacturer')->insert([
        ['id_manufacturer' => 1, 'name' => 'Acme'],
    ]);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        [
            'id_product' => 1,
            'id_manufacturer' => 1,
            'reference' => 'SKU-OLD',
            'active' => 1,
            'date_upd' => '2025-12-31 12:00:00',
        ],
        [
            'id_product' => 2,
            'id_manufacturer' => 1,
            'reference' => 'SKU-NEW',
            'active' => 1,
            'date_upd' => '2026-01-02 08:00:00',
        ],
        [
            'id_product' => 3,
            'id_manufacturer' => 1,
            'reference' => 'SKU-DISABLED',
            'active' => 0,
            'date_upd' => '2026-01-03 09:00:00',
        ],
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        ['id_product' => 2, 'id_lang' => 1, 'name' => 'Changed Product'],
    ]);

    DB::connection('tenant_ps')->table('ps_category_product')->insert([
        ['id_product' => 2, 'id_category' => 50],
    ]);

    app()->instance(TenantPrestaShopConnection::class, mock(TenantPrestaShopConnection::class, function (MockInterface $mock) use ($tenant): void {
        $mock->shouldReceive('connect')
            ->once()
            ->with(Mockery::on(static fn (mixed $resolvedTenant): bool => $resolvedTenant instanceof Tenant && $resolvedTenant->id === $tenant->id))
            ->andReturn(true);

        $mock->shouldReceive('table')
            ->andReturnUsing(static fn (string $table): string => 'ps_'.$table);
    }));

    app()->instance(PricingService::class, mock(PricingService::class, function (MockInterface $mock): void {
        $mock->shouldReceive('computeForProduct')
            ->once()
            ->with(2)
            ->andReturn([
                'original_price_tax_excl' => 100.0,
                'current_price_tax_excl' => 90.0,
                'original_price_tax_incl' => 121.0,
                'current_price_tax_incl' => 108.9,
                'discount_amount_tax_excl' => 10.0,
                'discount_percent' => 10.0,
            ]);
    }));

    app()->instance(TypeSenseClient::class, mock(TypeSenseClient::class, function (MockInterface $mock) use ($tenant): void {
        $mock->shouldReceive('ensureCollectionExists')
            ->once()
            ->with($tenant->id);

        $mock->shouldNotReceive('listProductDocIds');

        $mock->shouldReceive('upsertProductDoc')
            ->once()
            ->withArgs(function (int $tenantId, array $document) use ($tenant): bool {
                return $tenantId === $tenant->id
                    && ($document['id'] ?? null) === '2'
                    && ($document['name'] ?? null) === 'Changed Product';
            });

        $mock->shouldReceive('deleteProductDoc')
            ->once()
            ->with($tenant->id, '3');
    }));

    $result = app(TenantTypesenseProductBackfillService::class)->reindexTenant($tenant->id, 2, 'incremental');

    expect($result)->toMatchArray([
        'mode' => 'incremental',
        'processed' => 2,
        'upserted' => 1,
        'failed' => 0,
        'deleted' => 1,
        'stale_deleted' => 0,
        'inactive_deleted' => 1,
    ]);

    expect(Cache::get($watermarkKey))->toBe('2026-01-03 09:00:00');
});
