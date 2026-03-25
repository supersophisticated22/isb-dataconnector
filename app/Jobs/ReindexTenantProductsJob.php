<?php

namespace App\Jobs;

use App\Services\TenantTypesenseProductBackfillService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class ReindexTenantProductsJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $tenantId,
        public int $chunkSize = 100,
        public string $mode = 'incremental',
    ) {}

    public function handle(TenantTypesenseProductBackfillService $tenantTypesenseProductBackfillService): void
    {
        Log::info(__('saas.typesense.reindex.started', [
            'tenant_id' => $this->tenantId,
        ]));

        try {
            $result = $tenantTypesenseProductBackfillService->reindexTenant(
                tenantId: $this->tenantId,
                chunkSize: $this->chunkSize,
                mode: $this->mode,
            );

            Log::info(__('saas.typesense.reindex.completed', [
                'tenant_id' => $this->tenantId,
                'mode' => $result['mode'],
                'processed' => $result['processed'],
                'upserted' => $result['upserted'],
                'failed' => $result['failed'],
                'deleted' => $result['deleted'],
                'stale_deleted' => $result['stale_deleted'],
                'inactive_deleted' => $result['inactive_deleted'],
            ]));
        } catch (Throwable $exception) {
            Log::error(__('saas.typesense.reindex.failed', [
                'tenant_id' => $this->tenantId,
                'message' => $exception->getMessage(),
            ]));

            throw $exception;
        }
    }
}
