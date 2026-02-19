<?php

namespace App\Jobs;

use App\Models\Job;
use App\Services\BulkPriceUpdateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class FinalizeBulkPriceUpdateJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $jobId,
        public int $tenantId,
    ) {}

    public function handle(BulkPriceUpdateService $bulkPriceUpdateService): void
    {
        $job = Job::query()->find($this->jobId);

        if (! $job instanceof Job) {
            return;
        }

        if ($job->status === 'cancelled') {
            $job->forceFill([
                'finished_at' => now(),
            ])->save();

            $bulkPriceUpdateService->notifyInitiator($job, 'cancelled');

            return;
        }

        $summary = is_array($job->summary) ? $job->summary : [];
        $failedProducts = (int) ($summary['failed_products'] ?? 0);

        if ($failedProducts > 0) {
            $bulkPriceUpdateService->markJobAsFailed(
                $job,
                __('saas.pages.bulk_price_update.notifications.partial_failures', ['count' => $failedProducts]),
            );

            return;
        }

        $bulkPriceUpdateService->markJobAsCompleted($job);
    }
}
