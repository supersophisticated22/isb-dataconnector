<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class ProductSearchHistoryService
{
    /**
     * @return list<string>
     */
    public function recordAndGet(int $tenantId, string $identifier, ?string $query): array
    {
        $cacheKey = $this->cacheKey($tenantId, $identifier);

        /** @var mixed $cachedHistory */
        $cachedHistory = Cache::get($cacheKey, []);

        /** @var list<string> $history */
        $history = collect(is_array($cachedHistory) ? $cachedHistory : [])
            ->map(static fn (mixed $value): string => trim((string) $value))
            ->filter(static fn (string $value): bool => $value !== '')
            ->values()
            ->all();

        $resolvedQuery = trim((string) ($query ?? ''));

        if ($resolvedQuery !== '') {
            $history = collect([$resolvedQuery, ...$history])
                ->unique()
                ->take(10)
                ->values()
                ->all();

            Cache::forever($cacheKey, $history);
        }

        return $history;
    }

    private function cacheKey(int $tenantId, string $identifier): string
    {
        return 'api:v1:product-search-history:tenant:'.$tenantId.':'.sha1($identifier);
    }
}
