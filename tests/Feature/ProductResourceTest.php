<?php

use App\Filament\App\Resources\Products\ProductResource;
use App\Models\Tenant;
use App\Models\TenantPrestaShopProduct;
use App\Models\User;
use App\Services\TenantContext;
use App\Services\TypeSenseClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
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
