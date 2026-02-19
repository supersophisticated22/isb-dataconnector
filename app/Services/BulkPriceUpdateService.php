<?php

namespace App\Services;

use App\Models\Job;
use App\Models\Tenant;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

class BulkPriceUpdateService
{
    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
        private PricingService $pricingService,
        private ProductWriteService $productWriteService,
        private TypeSenseClient $typeSenseClient,
    ) {}

    /**
     * @param  array{manufacturer?:string,category?:string,min_price?:float|int|string,max_price?:float|int|string,has_discount?:bool}  $filters
     */
    public function previewCount(int $tenantId, array $filters): int
    {
        $results = $this->typeSenseClient->searchProductDocs(
            tenantId: $tenantId,
            query: '*',
            page: 1,
            perPage: 1,
            filters: $filters,
        );

        return (int) ($results['total'] ?? 0);
    }

    /**
     * @param  array{manufacturer?:string,category?:string,min_price?:float|int|string,max_price?:float|int|string,has_discount?:bool}  $filters
     * @return list<int>
     */
    public function resolveProductIds(int $tenantId, array $filters): array
    {
        $page = 1;
        $perPage = 250;
        $total = null;
        $productIds = [];

        do {
            $results = $this->typeSenseClient->searchProductDocs(
                tenantId: $tenantId,
                query: '*',
                page: $page,
                perPage: $perPage,
                filters: $filters,
            );

            $total ??= (int) ($results['total'] ?? 0);

            /** @var list<int> $pageIds */
            $pageIds = collect($results['data'] ?? [])
                ->map(fn (mixed $product): int => (int) data_get($product, 'id', 0))
                ->filter(fn (int $id): bool => $id > 0)
                ->values()
                ->all();

            if ($pageIds === []) {
                break;
            }

            array_push($productIds, ...$pageIds);
            $page++;
        } while (count($productIds) < ($total ?? 0));

        /** @var list<int> */
        return array_values(array_unique($productIds));
    }

    /**
     * @param  list<int>  $productIds
     * @return list<list<int>>
     */
    public function chunkProductIds(array $productIds, int $chunkSize = 100): array
    {
        if ($productIds === []) {
            return [];
        }

        $normalizedChunkSize = max(1, $chunkSize);

        /** @var list<list<int>> $chunks */
        $chunks = array_values(array_map(
            static fn (array $chunk): array => array_values($chunk),
            array_chunk($productIds, $normalizedChunkSize),
        ));

        return $chunks;
    }

    public function prepareTenantContext(int $tenantId): Tenant
    {
        $tenant = Tenant::query()->find($tenantId);

        if (! $tenant instanceof Tenant) {
            throw new RuntimeException('Tenant not found for bulk price update job.');
        }

        $this->tenantContext->setTenant($tenant);

        if (! $this->tenantPrestaShopConnection->connect($tenant)) {
            throw new RuntimeException('Unable to connect to tenant PrestaShop database.');
        }

        return $tenant;
    }

    /**
     * Rule:
     * - Product without active discount: update base price.
     * - Product with active discount: keep base price and create a product-level specific price with explicit target price.
     *
     * @param  array{direction:string,value_type:string,amount:float|int|string}  $operation
     * @return array{updated_base_price:bool,created_specific_price:bool,new_price:float}
     */
    public function applyOperationToProduct(int $productId, array $operation): array
    {
        $pricing = $this->pricingService->computeForProduct($productId);
        $hasActiveDiscount = (float) ($pricing['discount_amount_tax_excl'] ?? 0) > 0.000001;

        if ($hasActiveDiscount) {
            $targetPrice = $this->calculateTargetPrice(
                basePrice: (float) $pricing['current_price_tax_excl'],
                operation: $operation,
            );

            $this->productWriteService->createProductSpecificPrice($productId, [
                'price' => $targetPrice,
                'reduction' => 0,
                'reduction_type' => 'amount',
                'from' => Carbon::now()->format('Y-m-d H:i:s'),
                'to' => '0000-00-00 00:00:00',
            ]);

            return [
                'updated_base_price' => false,
                'created_specific_price' => true,
                'new_price' => $targetPrice,
            ];
        }

        $targetPrice = $this->calculateTargetPrice(
            basePrice: (float) $pricing['original_price_tax_excl'],
            operation: $operation,
        );

        $this->productWriteService->updateProductBasePrice($productId, $targetPrice);

        return [
            'updated_base_price' => true,
            'created_specific_price' => false,
            'new_price' => $targetPrice,
        ];
    }

    /**
     * @param  array<string, mixed>  $summaryDelta
     */
    public function updateJobProgress(int $jobId, int $processedIncrement, array $summaryDelta): void
    {
        $job = Job::query()->find($jobId);

        if (! $job instanceof Job || $job->status === 'cancelled') {
            return;
        }

        $summary = is_array($job->summary) ? $job->summary : [];

        foreach ($summaryDelta as $key => $value) {
            if (is_int($value) || is_float($value)) {
                $summary[$key] = (int) ($summary[$key] ?? 0) + (int) $value;

                continue;
            }

            $summary[$key] = $value;
        }

        $job->forceFill([
            'progress_current' => min(
                (int) $job->progress_total,
                max(0, (int) $job->progress_current + max(0, $processedIncrement))
            ),
            'summary' => $summary,
        ])->save();
    }

    public function markJobAsFailed(Job $job, string $message): void
    {
        if ($job->status === 'cancelled') {
            return;
        }

        $job->forceFill([
            'status' => 'failed',
            'error_message' => $message,
            'finished_at' => now(),
        ])->save();

        $this->notifyInitiator($job, 'failed');
    }

    public function markJobAsCompleted(Job $job): void
    {
        if ($job->status === 'cancelled') {
            return;
        }

        $job->forceFill([
            'status' => 'completed',
            'finished_at' => now(),
        ])->save();

        $this->notifyInitiator($job, 'completed');
    }

    public function notifyInitiator(Job $job, string $status): void
    {
        if (! Schema::hasTable('notifications')) {
            return;
        }

        $summary = is_array($job->summary) ? $job->summary : [];
        $tenantUserId = (int) ($summary['initiator_tenant_user_id'] ?? 0);

        if ($tenantUserId < 1) {
            return;
        }

        $tenantUser = User::query()
            ->whereHas('tenants', function ($query) use ($job): void {
                $query->where('tenants.id', $job->tenant_id)
                    ->where('tenant_user.status', 'active');
            })
            ->whereKey($tenantUserId)
            ->first();

        if (! $tenantUser instanceof User) {
            return;
        }

        $processed = (int) ($job->progress_current ?? 0);
        $failed = (int) ($summary['failed_products'] ?? 0);

        $notification = Notification::make()
            ->title(__('saas.pages.bulk_price_update.notifications.job_'.$status.'_title', ['job_id' => $job->id]))
            ->body(__('saas.pages.bulk_price_update.notifications.job_'.$status.'_body', [
                'processed' => $processed,
                'failed' => $failed,
            ]));

        if ($status === 'completed') {
            $notification->success();
        } elseif ($status === 'cancelled') {
            $notification->warning();
        } else {
            $notification->danger();
        }

        $notification->sendToDatabase($tenantUser);
    }

    /**
     * @param  array{direction:string,value_type:string,amount:float|int|string}  $operation
     */
    private function calculateTargetPrice(float $basePrice, array $operation): float
    {
        $direction = (string) ($operation['direction'] ?? 'increase');
        $valueType = (string) ($operation['value_type'] ?? 'fixed');
        $amount = max(0, (float) ($operation['amount'] ?? 0));

        $delta = $valueType === 'percent'
            ? $basePrice * ($amount / 100)
            : $amount;

        $targetPrice = $direction === 'decrease'
            ? max(0, $basePrice - $delta)
            : $basePrice + $delta;

        return round($targetPrice, 6);
    }
}
