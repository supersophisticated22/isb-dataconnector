<?php

namespace App\Services;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CmsPerformanceProbe
{
    public function enabled(): bool
    {
        return (bool) config('app.cms_perf_profiling', false);
    }

    public function boot(string $resource): void
    {
        if (! $this->enabled()) {
            return;
        }

        $request = $this->resolveRequest();

        if (! $request instanceof Request) {
            return;
        }

        $request->attributes->set('cms_perf_resource', $resource);

        if ($request->attributes->get('cms_perf_listener_registered', false) === true) {
            return;
        }

        $request->attributes->set('cms_perf_listener_registered', true);
        $request->attributes->set('cms_perf_query_count', 0);
        $request->attributes->set('cms_perf_query_time_ms', 0.0);

        DB::listen(function (QueryExecuted $query) use ($request): void {
            if ($query->connectionName !== 'tenant_ps') {
                return;
            }

            $count = (int) $request->attributes->get('cms_perf_query_count', 0);
            $timeMs = (float) $request->attributes->get('cms_perf_query_time_ms', 0.0);

            $request->attributes->set('cms_perf_query_count', $count + 1);
            $request->attributes->set('cms_perf_query_time_ms', $timeMs + (float) $query->time);
        });
    }

    /**
     * @template T
     *
     * @param  callable():T  $callback
     * @param  array<string, mixed>  $context
     * @return T
     */
    public function measure(string $operation, callable $callback, array $context = []): mixed
    {
        if (! $this->enabled()) {
            return $callback();
        }

        $startedAt = microtime(true);

        try {
            return $callback();
        } finally {
            $this->logTiming($operation, (microtime(true) - $startedAt) * 1000, $context);
        }
    }

    /**
     * @param  array<string, mixed>  $context
     */
    public function logTiming(string $operation, float $durationMs, array $context = []): void
    {
        if (! $this->enabled()) {
            return;
        }

        $request = $this->resolveRequest();
        $resource = $request instanceof Request
            ? (string) $request->attributes->get('cms_perf_resource', '')
            : '';

        Log::debug('CMS performance probe', [
            'resource' => $resource,
            'operation' => $operation,
            'duration_ms' => round($durationMs, 2),
            ...$this->sqlStats(),
            ...$context,
        ]);
    }

    /**
     * @return array{tenant_ps_query_count:int,tenant_ps_query_time_ms:float}
     */
    public function sqlStats(): array
    {
        $request = $this->resolveRequest();

        if (! $request instanceof Request) {
            return [
                'tenant_ps_query_count' => 0,
                'tenant_ps_query_time_ms' => 0.0,
            ];
        }

        return [
            'tenant_ps_query_count' => (int) $request->attributes->get('cms_perf_query_count', 0),
            'tenant_ps_query_time_ms' => round((float) $request->attributes->get('cms_perf_query_time_ms', 0.0), 2),
        ];
    }

    private function resolveRequest(): ?Request
    {
        $request = app()->bound('request') ? app('request') : null;

        return $request instanceof Request ? $request : null;
    }
}
