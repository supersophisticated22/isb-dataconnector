<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

if ((bool) config('services.typesense.sync_enabled', true)) {
    $syncChunk = max(1, (int) config('services.typesense.sync_chunk', 100));
    $syncSchedule = (string) config('services.typesense.sync_schedule', '*/10 * * * *');

    Schedule::command("app:typesense-reindex-tenant-products --all --mode=incremental --chunk={$syncChunk}")
        ->cron($syncSchedule)
        ->withoutOverlapping();
}

if ((bool) config('services.typesense.full_sync_enabled', true)) {
    $fullSyncChunk = max(1, (int) config('services.typesense.sync_chunk', 100));
    $fullSyncSchedule = (string) config('services.typesense.full_sync_schedule', '0 3 * * *');

    Schedule::command("app:typesense-reindex-tenant-products --all --mode=full --chunk={$fullSyncChunk}")
        ->cron($fullSyncSchedule)
        ->withoutOverlapping();
}
