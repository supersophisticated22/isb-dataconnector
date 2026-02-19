<?php

namespace App\Jobs;

use App\Models\Job;
use App\Services\BulkPriceUpdateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Bus;
use Throwable;

class StartBulkPriceUpdateJob implements ShouldQueue
{
    use Queueable;

    /**
     * @param  array{manufacturer?:string,category?:string,min_price?:float|int|string,max_price?:float|int|string,has_discount?:bool}  $filters
     * @param  array{direction:string,value_type:string,amount:float|int|string}  $operation
     */
    public function __construct(
        public int $jobId,
        public int $tenantId,
        public array $filters,
        public array $operation,
    ) {}

    public function handle(BulkPriceUpdateService $bulkPriceUpdateService): void
    {
        $job = Job::query()->find($this->jobId);

        if (! $job instanceof Job || $job->status === 'cancelled') {
            return;
        }

        try {
            $bulkPriceUpdateService->prepareTenantContext($this->tenantId);

            $productIds = $bulkPriceUpdateService->resolveProductIds($this->tenantId, $this->filters);
            $chunks = $bulkPriceUpdateService->chunkProductIds($productIds, 100);

            $summary = is_array($job->summary) ? $job->summary : [];

            $job->forceFill([
                'status' => 'running',
                'started_at' => $job->started_at ?? now(),
                'progress_total' => count($productIds),
                'summary' => [
                    ...$summary,
                    'matched_products' => count($productIds),
                    'updated_base_price_count' => 0,
                    'created_specific_price_count' => 0,
                    'failed_products' => 0,
                ],
            ])->save();

            if ($productIds === []) {
                $job->forceFill([
                    'progress_current' => 0,
                ])->save();

                $bulkPriceUpdateService->markJobAsCompleted($job);

                return;
            }

            $chainJobs = [];

            foreach ($chunks as $chunkProductIds) {
                $chainJobs[] = new ProcessBulkPriceUpdateChunkJob(
                    jobId: $this->jobId,
                    tenantId: $this->tenantId,
                    productIds: $chunkProductIds,
                    operation: $this->operation,
                );
            }

            $chainJobs[] = new FinalizeBulkPriceUpdateJob(
                jobId: $this->jobId,
                tenantId: $this->tenantId,
            );

            $jobId = $this->jobId;

            Bus::chain($chainJobs)
                ->catch(function (Throwable $throwable) use ($jobId): void {
                    $job = Job::query()->find($jobId);

                    if (! $job instanceof Job) {
                        return;
                    }

                    app(BulkPriceUpdateService::class)->markJobAsFailed($job, $throwable->getMessage());
                })
                ->dispatch();
        } catch (Throwable $throwable) {
            $bulkPriceUpdateService->markJobAsFailed($job, $throwable->getMessage());
        }
    }
}
