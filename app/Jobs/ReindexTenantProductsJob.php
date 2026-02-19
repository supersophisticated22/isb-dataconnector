<?php

namespace App\Jobs;

use App\Services\TypeSenseClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class ReindexTenantProductsJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public int $tenantId) {}

    public function handle(TypeSenseClient $typeSenseClient): void
    {
        Log::info(__('saas.typesense.reindex.started', [
            'tenant_id' => $this->tenantId,
        ]));

        try {
            $typeSenseClient->ensureCollectionExists($this->tenantId);

            Log::info(__('saas.typesense.reindex.completed', [
                'tenant_id' => $this->tenantId,
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
