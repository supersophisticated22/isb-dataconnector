<?php

use App\Jobs\ReindexTenantProductsJob;
use App\Models\Tenant;
use App\Services\TenantTypesenseProductBackfillService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Mockery\MockInterface;

uses(RefreshDatabase::class);

it('queues reindex job for a specific tenant', function (): void {
    $tenant = Tenant::factory()->create();

    Bus::fake();

    $this->artisan("app:typesense-reindex-tenant-products {$tenant->id} --chunk=75")
        ->assertSuccessful();

    Bus::assertDispatched(ReindexTenantProductsJob::class, function (ReindexTenantProductsJob $job) use ($tenant): bool {
        return $job->tenantId === $tenant->id
            && $job->chunkSize === 75
            && $job->mode === 'incremental';
    });
});

it('runs sync reindex for all tenants', function (): void {
    $tenantA = Tenant::factory()->create();
    $tenantB = Tenant::factory()->create();

    app()->instance(TenantTypesenseProductBackfillService::class, mock(TenantTypesenseProductBackfillService::class, function (MockInterface $mock) use ($tenantA, $tenantB): void {
        $mock->shouldReceive('reindexTenant')
            ->once()
            ->with($tenantA->id, 20, 'incremental')
            ->andReturn([
                'mode' => 'incremental',
                'processed' => 0,
                'upserted' => 0,
                'failed' => 0,
                'deleted' => 0,
                'stale_deleted' => 0,
                'inactive_deleted' => 0,
            ]);

        $mock->shouldReceive('reindexTenant')
            ->once()
            ->with($tenantB->id, 20, 'incremental')
            ->andReturn([
                'mode' => 'incremental',
                'processed' => 0,
                'upserted' => 0,
                'failed' => 0,
                'deleted' => 0,
                'stale_deleted' => 0,
                'inactive_deleted' => 0,
            ]);
    }));

    $this->artisan('app:typesense-reindex-tenant-products --all --sync --chunk=20')
        ->assertSuccessful();
});

it('queues full reindex mode when requested', function (): void {
    $tenant = Tenant::factory()->create();

    Bus::fake();

    $this->artisan("app:typesense-reindex-tenant-products {$tenant->id} --mode=full")
        ->assertSuccessful();

    Bus::assertDispatched(ReindexTenantProductsJob::class, function (ReindexTenantProductsJob $job) use ($tenant): bool {
        return $job->tenantId === $tenant->id
            && $job->mode === 'full';
    });
});
