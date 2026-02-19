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

    private function collectionName(int $tenantId): string
    {
        return 'products__'.$tenantId;
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
        throw new RuntimeException($message.' Status: '.$response->status());
    }
}
