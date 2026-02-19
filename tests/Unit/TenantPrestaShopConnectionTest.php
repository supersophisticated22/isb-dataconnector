<?php

use App\Models\Tenant;
use App\Services\TenantPrestaShopConnection;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

uses(TestCase::class);

it('prefixes prestashop table names with tenant prefix', function () {
    $tenant = makeTenant([
        'db_prefix' => 'ps_custom_',
    ]);

    $service = app(TenantPrestaShopConnection::class);

    expect($service->table('product', $tenant))->toBe('ps_custom_product');
});

it('attempts connection and fails gracefully when reconnect throws', function () {
    $tenant = makeTenant();

    DB::shouldReceive('purge')
        ->once()
        ->with('tenant_ps');

    DB::shouldReceive('reconnect')
        ->once()
        ->with('tenant_ps')
        ->andThrow(new RuntimeException('Connection failed'));

    $service = app(TenantPrestaShopConnection::class);

    expect($service->connect($tenant))->toBeFalse();
});

/**
 * @param  array<string, mixed>  $attributes
 */
function makeTenant(array $attributes = []): Tenant
{
    $tenant = new Tenant;
    $tenant->setRawAttributes(array_merge([
        'id' => 1,
        'name' => 'Tenant',
        'slug' => 'tenant',
        'db_host' => '127.0.0.1',
        'db_port' => 3306,
        'db_name' => 'prestashop',
        'db_user' => 'user',
        'db_password' => 'secret',
        'db_prefix' => 'ps_',
        'base_shop_url' => 'https://tenant.example.test',
        'status' => 'active',
    ], $attributes));

    return $tenant;
}
