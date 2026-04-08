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
            ->withArgs(function (int $tenantId, int $chunkSize, string $mode, ?callable $onProgress) use ($tenantA): bool {
                return $tenantId === $tenantA->id
                    && $chunkSize === 20
                    && $mode === 'incremental'
                    && $onProgress !== null;
            })
            ->andReturnUsing(function (int $tenantId, int $chunkSize, string $mode, ?callable $onProgress): array {
                if ($onProgress !== null) {
                    $onProgress([
                        'processed' => 10,
                        'upserted' => 9,
                        'failed' => 1,
                    ]);
                }

                return [
                    'mode' => 'incremental',
                    'processed' => 10,
                    'upserted' => 9,
                    'failed' => 1,
                    'deleted' => 0,
                    'stale_deleted' => 0,
                    'inactive_deleted' => 0,
                ];
            });

        $mock->shouldReceive('reindexTenant')
            ->once()
            ->withArgs(function (int $tenantId, int $chunkSize, string $mode, ?callable $onProgress) use ($tenantB): bool {
                return $tenantId === $tenantB->id
                    && $chunkSize === 20
                    && $mode === 'incremental'
                    && $onProgress !== null;
            })
            ->andReturnUsing(function (int $tenantId, int $chunkSize, string $mode, ?callable $onProgress): array {
                if ($onProgress !== null) {
                    $onProgress([
                        'processed' => 3,
                        'upserted' => 3,
                        'failed' => 0,
                    ]);
                }

                return [
                    'mode' => 'incremental',
                    'processed' => 3,
                    'upserted' => 3,
                    'failed' => 0,
                    'deleted' => 0,
                    'stale_deleted' => 0,
                    'inactive_deleted' => 0,
                ];
            });
    }));

    $this->artisan('app:typesense-reindex-tenant-products --all --sync --chunk=20')
        ->expectsOutputToContain("Tenant {$tenantA->id} sync incremental reindex started.")
        ->expectsOutputToContain("Tenant {$tenantA->id} progress (processed=10, upserted=9, failed=1).")
        ->expectsOutputToContain("Tenant {$tenantB->id} sync incremental reindex started.")
        ->expectsOutputToContain("Tenant {$tenantB->id} progress (processed=3, upserted=3, failed=0).")
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
