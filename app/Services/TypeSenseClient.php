<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class TypeSenseClient
{
    public function ensureCollectionExists(int $tenantId): void
    {
        $collectionName = $this->collectionName($tenantId);

        $response = $this->http()->get("/collections/{$collectionName}");

        if ($response->status() === 200) {
            return;
        }

        if ($response->status() !== 404) {
            $this->throwUnexpectedResponse('Failed checking TypeSense collection.', $response);
        }

        $createResponse = $this->http()->post('/collections', [
            'name' => $collectionName,
            'fields' => [
                ['name' => 'id', 'type' => 'string'],
                ['name' => 'name', 'type' => 'string'],
                ['name' => 'reference', 'type' => 'string'],
                ['name' => 'active', 'type' => 'bool'],
                ['name' => 'manufacturer_name', 'type' => 'string'],
                ['name' => 'category_ids', 'type' => 'string[]'],
                ['name' => 'original_price_tax_excl', 'type' => 'float'],
                ['name' => 'current_price_tax_excl', 'type' => 'float'],
                ['name' => 'original_price_tax_incl', 'type' => 'float'],
                ['name' => 'current_price_tax_incl', 'type' => 'float'],
                ['name' => 'discount_amount_tax_excl', 'type' => 'float'],
                ['name' => 'discount_percent', 'type' => 'float'],
                ['name' => 'product_url', 'type' => 'string'],
                ['name' => 'image_url', 'type' => 'string'],
                ['name' => 'updated_at', 'type' => 'int64'],
            ],
        ]);

        if (! $createResponse->successful()) {
            $this->throwUnexpectedResponse('Failed creating TypeSense collection.', $createResponse);
        }
    }

    /**
     * @param  array<string, mixed>  $document
     */
    public function upsertProductDoc(int $tenantId, array $document): void
    {
        $collectionName = $this->collectionName($tenantId);
        $response = $this->http()
            ->post("/collections/{$collectionName}/documents?action=upsert", $document);

        if (! $response->successful()) {
            $this->throwUnexpectedResponse('Failed upserting TypeSense product document.', $response);
        }
    }

    public function deleteProductDoc(int $tenantId, int|string $productId): void
    {
        $collectionName = $this->collectionName($tenantId);
        $encodedProductId = rawurlencode((string) $productId);

        $response = $this->http()
            ->delete("/collections/{$collectionName}/documents/{$encodedProductId}");

        if (! $response->successful() && $response->status() !== 404) {
            $this->throwUnexpectedResponse('Failed deleting TypeSense product document.', $response);
        }
    }

    /**
     * @return list<string>
     */
    public function listProductDocIds(int $tenantId, int $perPage = 250): array
    {
        $collectionName = $this->collectionName($tenantId);
        $resolvedPerPage = max(1, min($perPage, 250));
        $page = 1;
        $found = null;
        $documentIds = [];

        while (true) {
            $response = $this->http()->get("/collections/{$collectionName}/documents/search", [
                'q' => '*',
                'query_by' => 'name',
                'page' => $page,
                'per_page' => $resolvedPerPage,
            ]);

            if ($response->status() === 404) {
                return [];
            }

            if (! $response->successful()) {
                $this->throwUnexpectedResponse('Failed listing TypeSense product documents.', $response);
            }

            $payload = $response->json();
            $hits = is_array($payload['hits'] ?? null) ? $payload['hits'] : [];
            $found ??= (int) ($payload['found'] ?? 0);

            foreach ($hits as $hit) {
                if (! is_array($hit) || ! is_array($hit['document'] ?? null)) {
                    continue;
                }

                $documentId = $hit['document']['id'] ?? null;

                if (is_scalar($documentId)) {
                    $documentIds[] = (string) $documentId;
                }
            }

            if ($hits === [] || count($documentIds) >= $found) {
                break;
            }

            $page++;
        }

        return array_values(array_unique($documentIds));
    }

    /**
     * @param  array<string, mixed>  $filters
     * @return array{data: array<int, array<string, mixed>>, total: int}
     */
    public function searchProductDocs(int $tenantId, string $query, int $page, int $perPage, array $filters = []): array
    {
        $collectionName = $this->collectionName($tenantId);

        $response = $this->http()->get("/collections/{$collectionName}/documents/search", [
            'q' => trim($query) !== '' ? $query : '*',
            'query_by' => 'name,reference,manufacturer_name',
            'page' => $page,
            'per_page' => $perPage,
            'filter_by' => $this->buildProductFilterBy($filters),
            'sort_by' => 'updated_at:desc',
        ]);

        if (! $response->successful()) {
            $this->throwUnexpectedResponse('Failed searching TypeSense products.', $response);
        }

        $payload = $response->json();
        $hits = is_array($payload['hits'] ?? null) ? $payload['hits'] : [];
        $documents = [];

        foreach ($hits as $hit) {
            if (is_array($hit) && is_array($hit['document'] ?? null)) {
                $documents[] = $hit['document'];
            }
        }

        return [
            'data' => $documents,
            'total' => (int) ($payload['found'] ?? count($documents)),
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getProductDoc(int $tenantId, int|string $productId): ?array
    {
        $collectionName = $this->collectionName($tenantId);
        $encodedProductId = rawurlencode((string) $productId);

        $response = $this->http()
            ->get("/collections/{$collectionName}/documents/{$encodedProductId}");

        if ($response->status() === 404) {
            return null;
        }

        if (! $response->successful()) {
            $this->throwUnexpectedResponse('Failed fetching TypeSense product document.', $response);
        }

        $payload = $response->json();

        return is_array($payload) ? $payload : null;
    }

    private function collectionName(int $tenantId): string
    {
        return 'products__'.$tenantId;
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    private function buildProductFilterBy(array $filters): string
    {
        $segments = ['active:=true'];

        if (isset($filters['category']) && is_string($filters['category']) && $filters['category'] !== '') {
            $segments[] = 'category_ids:='.$this->escapeFilterValue($filters['category']);
        }

        if (isset($filters['manufacturer']) && is_string($filters['manufacturer']) && $filters['manufacturer'] !== '') {
            $segments[] = 'manufacturer_name:='.$this->escapeFilterValue($filters['manufacturer']);
        }

        if (isset($filters['min_price']) && is_numeric($filters['min_price'])) {
            $segments[] = 'current_price_tax_excl:>='.(float) $filters['min_price'];
        }

        if (isset($filters['max_price']) && is_numeric($filters['max_price'])) {
            $segments[] = 'current_price_tax_excl:<='.(float) $filters['max_price'];
        }

        if (array_key_exists('has_discount', $filters)) {
            $segments[] = filter_var($filters['has_discount'], FILTER_VALIDATE_BOOLEAN)
                ? 'discount_amount_tax_excl:>0'
                : 'discount_amount_tax_excl:<=0';
        }

        return implode(' && ', $segments);
    }

    private function escapeFilterValue(string $value): string
    {
        return '`'.str_replace('`', '\`', trim($value)).'`';
    }

    private function http(): PendingRequest
    {
        $baseUrl = rtrim((string) config('services.typesense.url'), '/');
        $apiKey = (string) config('services.typesense.key');
        $timeout = (int) config('services.typesense.timeout', 10);

        return Http::baseUrl($baseUrl)
            ->withHeaders([
                'X-TYPESENSE-API-KEY' => $apiKey,
            ])
            ->acceptJson()
            ->asJson()
            ->timeout($timeout);
    }

    private function throwUnexpectedResponse(string $message, Response $response): never
    {
        $responseBody = trim((string) $response->body());

        if ($responseBody !== '') {
            $maxBodyLength = 500;

            if (strlen($responseBody) > $maxBodyLength) {
                $responseBody = substr($responseBody, 0, $maxBodyLength).'...';
            }

            throw new RuntimeException($message.' Status: '.$response->status().' Body: '.$responseBody);
        }

        throw new RuntimeException($message.' Status: '.$response->status());
    }
}
