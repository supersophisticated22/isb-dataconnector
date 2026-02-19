<?php

namespace App\Jobs;

use App\Models\Job;
use App\Services\BulkPriceUpdateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Throwable;

class ProcessBulkPriceUpdateChunkJob implements ShouldQueue
{
    use Queueable;

    /**
     * @param  list<int>  $productIds
     * @param  array{direction:string,value_type:string,amount:float|int|string}  $operation
     */
    public function __construct(
        public int $jobId,
        public int $tenantId,
        public array $productIds,
        public array $operation,
    ) {}

    public function handle(BulkPriceUpdateService $bulkPriceUpdateService): void
    {
        $job = Job::query()->find($this->jobId);

        if (! $job instanceof Job || $job->status === 'cancelled') {
            return;
        }

        $bulkPriceUpdateService->prepareTenantContext($this->tenantId);

        $processed = 0;
        $updatedBasePriceCount = 0;
        $createdSpecificPriceCount = 0;
        $failedProducts = 0;

        foreach ($this->productIds as $productId) {
            if ($job->fresh()?->status === 'cancelled') {
                break;
            }

            try {
                $result = $bulkPriceUpdateService->applyOperationToProduct($productId, $this->operation);

                if (($result['updated_base_price'] ?? false) === true) {
                    $updatedBasePriceCount++;
                }

                if (($result['created_specific_price'] ?? false) === true) {
                    $createdSpecificPriceCount++;
                }
            } catch (Throwable) {
                $failedProducts++;
            }

            $processed++;
        }

        $bulkPriceUpdateService->updateJobProgress($this->jobId, $processed, [
            'updated_base_price_count' => $updatedBasePriceCount,
            'created_specific_price_count' => $createdSpecificPriceCount,
            'failed_products' => $failedProducts,
        ]);
    }
}
