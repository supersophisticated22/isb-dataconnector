<?php

use App\Models\Job;
use App\Models\Tenant;
use App\Models\User;
use App\Services\BulkPriceUpdateService;
use App\Services\PricingService;
use App\Services\ProductWriteService;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopConnection;
use App\Services\TypeSenseClient;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('updates base price when product has no active discount', function (): void {
    $tenantContext = mock(TenantContext::class);
    $tenantConnection = mock(TenantPrestaShopConnection::class);
    $pricingService = mock(PricingService::class);
    $productWriteService = mock(ProductWriteService::class);
    $typeSenseClient = mock(TypeSenseClient::class);

    $pricingService
        ->shouldReceive('computeForProduct')
        ->once()
        ->with(10)
        ->andReturn([
            'original_price_tax_excl' => 100.0,
            'current_price_tax_excl' => 100.0,
            'discount_amount_tax_excl' => 0.0,
        ]);

    $productWriteService
        ->shouldReceive('updateProductBasePrice')
        ->once()
        ->with(10, 110.0);

    $service = new BulkPriceUpdateService(
        $tenantContext,
        $tenantConnection,
        $pricingService,
        $productWriteService,
        $typeSenseClient,
    );

    $result = $service->applyOperationToProduct(10, [
        'direction' => 'increase',
        'value_type' => 'percent',
        'amount' => 10,
    ]);

    expect($result['updated_base_price'])->toBeTrue()
        ->and($result['created_specific_price'])->toBeFalse()
        ->and($result['new_price'])->toBe(110.0);
});

it('creates specific price when product has active discount', function (): void {
    $tenantContext = mock(TenantContext::class);
    $tenantConnection = mock(TenantPrestaShopConnection::class);
    $pricingService = mock(PricingService::class);
    $productWriteService = mock(ProductWriteService::class);
    $typeSenseClient = mock(TypeSenseClient::class);

    $pricingService
        ->shouldReceive('computeForProduct')
        ->once()
        ->with(22)
        ->andReturn([
            'original_price_tax_excl' => 100.0,
            'current_price_tax_excl' => 80.0,
            'discount_amount_tax_excl' => 20.0,
        ]);

    $productWriteService
        ->shouldReceive('createProductSpecificPrice')
        ->once()
        ->withArgs(function (int $productId, array $payload): bool {
            return $productId === 22
                && (float) ($payload['price'] ?? -1) === 72.0
                && (float) ($payload['reduction'] ?? -1) === 0.0
                && ($payload['reduction_type'] ?? null) === 'amount';
        });

    $service = new BulkPriceUpdateService(
        $tenantContext,
        $tenantConnection,
        $pricingService,
        $productWriteService,
        $typeSenseClient,
    );

    $result = $service->applyOperationToProduct(22, [
        'direction' => 'decrease',
        'value_type' => 'fixed',
        'amount' => 8,
    ]);

    expect($result['updated_base_price'])->toBeFalse()
        ->and($result['created_specific_price'])->toBeTrue()
        ->and($result['new_price'])->toBe(72.0);
});

it('updates jobs table progress and summary counters', function (): void {
    $tenant = Tenant::factory()->create();
    $tenantUser = User::factory()->create();
    $tenantUser->tenants()->attach($tenant->id, [
        'role' => 'admin',
        'status' => 'active',
    ]);

    $job = Job::query()->create([
        'tenant_id' => $tenant->id,
        'created_by_user_id' => null,
        'created_by_tenant_user_id' => $tenantUser->id,
        'type' => 'bulk_price_update_v2',
        'status' => 'running',
        'progress_current' => 0,
        'progress_total' => 10,
        'summary' => [
            'updated_base_price_count' => 0,
            'created_specific_price_count' => 0,
            'failed_products' => 0,
        ],
    ]);

    $service = new BulkPriceUpdateService(
        mock(TenantContext::class),
        mock(TenantPrestaShopConnection::class),
        mock(PricingService::class),
        mock(ProductWriteService::class),
        mock(TypeSenseClient::class),
    );

    $service->updateJobProgress($job->id, 4, [
        'updated_base_price_count' => 3,
        'created_specific_price_count' => 1,
        'failed_products' => 1,
    ]);

    $freshJob = $job->fresh();

    expect($freshJob)->not->toBeNull()
        ->and((int) ($freshJob?->progress_current ?? 0))->toBe(4)
        ->and((int) ($freshJob?->summary['updated_base_price_count'] ?? 0))->toBe(3)
        ->and((int) ($freshJob?->summary['created_specific_price_count'] ?? 0))->toBe(1)
        ->and((int) ($freshJob?->summary['failed_products'] ?? 0))->toBe(1);
});
