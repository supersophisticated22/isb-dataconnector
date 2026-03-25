<?php

namespace App\Console\Commands;

use App\Jobs\ReindexTenantProductsJob;
use App\Models\Tenant;
use App\Services\TenantTypesenseProductBackfillService;
use Illuminate\Console\Command;

class TypesenseReindexTenantProductsCommand extends Command
{
    protected $signature = 'app:typesense-reindex-tenant-products
        {tenantId? : Tenant id}
        {--all : Reindex all tenants}
        {--chunk=100 : Chunk size used for tenant PrestaShop reads}
        {--mode=incremental : Reindex mode (incremental|full)}
        {--sync : Run the backfill in-process instead of queueing jobs}';

    protected $description = 'Reindex tenant products directly from tenant PrestaShop DB into Typesense.';

    /**
     * Execute the console command.
     */
    public function handle(TenantTypesenseProductBackfillService $tenantTypesenseProductBackfillService): int
    {
        $tenantIdOption = $this->argument('tenantId');
        $all = (bool) $this->option('all');
        $sync = (bool) $this->option('sync');
        $chunkSize = max(1, (int) $this->option('chunk'));
        $mode = strtolower((string) $this->option('mode'));

        if (! in_array($mode, ['incremental', 'full'], true)) {
            $this->error('Invalid --mode value. Allowed: incremental, full.');

            return self::FAILURE;
        }

        if (! $all && $tenantIdOption === null) {
            $this->error('Provide tenantId or use --all.');

            return self::FAILURE;
        }

        $tenantIds = $all
            ? Tenant::query()->orderBy('id')->pluck('id')->map(static fn (mixed $id): int => (int) $id)->all()
            : [(int) $tenantIdOption];

        if ($tenantIds === []) {
            $this->warn('No tenants found.');

            return self::SUCCESS;
        }

        foreach ($tenantIds as $tenantId) {
            if ($tenantId < 1) {
                $this->warn("Skipping invalid tenant id: {$tenantId}");

                continue;
            }

            if (! $sync) {
                ReindexTenantProductsJob::dispatch($tenantId, $chunkSize, $mode);
                $this->info("Queued Typesense {$mode} reindex for tenant {$tenantId}.");

                continue;
            }

            $result = $tenantTypesenseProductBackfillService->reindexTenant($tenantId, $chunkSize, $mode);
            $this->line(
                sprintf(
                    'Tenant %d %s reindexed (processed=%d, upserted=%d, failed=%d, deleted=%d, stale_deleted=%d, inactive_deleted=%d).',
                    $tenantId,
                    $result['mode'],
                    $result['processed'],
                    $result['upserted'],
                    $result['failed'],
                    $result['deleted'],
                    $result['stale_deleted'],
                    $result['inactive_deleted'],
                )
            );
        }

        return self::SUCCESS;
    }
}
