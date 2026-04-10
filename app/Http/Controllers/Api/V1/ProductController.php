<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ListProductsRequest;
use App\Http\Requests\Api\V1\SearchProductsRequest;
use App\Services\ProductSearchHistoryService;
use App\Services\TenantContext;
use App\Services\TypeSenseClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class ProductController extends Controller
{
    public function __construct(
        private TypeSenseClient $typeSenseClient,
        private TenantContext $tenantContext,
        private ProductSearchHistoryService $productSearchHistoryService,
    ) {}

    public function index(ListProductsRequest $request): JsonResponse
    {
        $tenantId = $this->resolveTenantId();
        $validated = $request->validated();
        $page = (int) ($validated['page'] ?? 1);
        $perPage = (int) ($validated['per_page'] ?? 15);

        $results = $this->typeSenseClient->searchProductDocs(
            tenantId: $tenantId,
            query: (string) ($validated['q'] ?? ''),
            page: $page,
            perPage: $perPage,
            filters: [
                'category' => $validated['category'] ?? null,
                'manufacturer' => $validated['manufacturer'] ?? null,
                'min_price' => $validated['min_price'] ?? null,
                'max_price' => $validated['max_price'] ?? null,
                'has_discount' => $validated['has_discount'] ?? null,
            ],
        );

        return response()->json([
            'data' => collect($results['data'])
                ->filter(fn (array $product): bool => $this->isActive($product))
                ->map(fn (array $product): array => $this->transformProduct($product))
                ->values()
                ->all(),
            'meta' => [
                'page' => $page,
                'per_page' => $perPage,
                'total' => (int) $results['total'],
            ],
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $tenantId = $this->resolveTenantId();
        $product = $this->typeSenseClient->getProductDoc($tenantId, $id);

        if ($product === null || ! $this->isActive($product)) {
            return response()->json([
                'message' => __('saas.api.products.not_found'),
            ], 404);
        }

        return response()->json([
            'data' => $this->transformProduct($product),
        ]);
    }

    public function search(SearchProductsRequest $request): JsonResponse
    {
        $tenantId = $this->resolveTenantId();
        $validated = $request->validated();
        $page = (int) ($validated['page'] ?? 1);
        $perPage = (int) ($validated['per_page'] ?? 15);
        $query = (string) ($validated['q'] ?? '');

        $searchResults = $this->typeSenseClient->searchProductDocsWithFacets(
            tenantId: $tenantId,
            query: $query,
            page: $page,
            perPage: $perPage,
            filters: [
                'category' => $validated['category'] ?? null,
                'brand' => $validated['brand'] ?? null,
                'manufacturer' => $validated['manufacturer'] ?? null,
                'min_price' => $validated['min_price'] ?? null,
                'max_price' => $validated['max_price'] ?? null,
                'has_discount' => $validated['has_discount'] ?? null,
            ],
        );

        $history = $this->productSearchHistoryService->recordAndGet(
            tenantId: $tenantId,
            identifier: $this->resolveHistoryIdentifier($request),
            query: $query,
        );

        return response()->json([
            'facets' => $searchResults['facets'],
            'results' => collect($searchResults['data'])
                ->filter(fn (array $product): bool => $this->isActive($product))
                ->map(fn (array $product): array => $this->transformSearchProduct($product))
                ->values()
                ->all(),
            'total' => (int) $searchResults['total'],
            'history' => $history,
        ]);
    }

    private function resolveTenantId(): int
    {
        $tenantId = $this->tenantContext->tenantId();

        if (! is_int($tenantId) || $tenantId < 1) {
            throw new RuntimeException('Tenant context is missing.');
        }

        return $tenantId;
    }

    /**
     * @param  array<string, mixed>  $product
     * @return array<string, mixed>
     */
    private function transformProduct(array $product): array
    {
        $productId = (int) ($product['id'] ?? 0);

        return [
            'id' => $productId,
            'name' => (string) ($product['name'] ?? ''),
            'reference' => (string) ($product['reference'] ?? ''),
            'manufacturer' => (string) ($product['manufacturer_name'] ?? ''),
            'original_price_tax_excl' => (float) ($product['original_price_tax_excl'] ?? 0),
            'current_price_tax_excl' => (float) ($product['current_price_tax_excl'] ?? 0),
            'original_price_tax_incl' => (float) ($product['original_price_tax_incl'] ?? 0),
            'current_price_tax_incl' => (float) ($product['current_price_tax_incl'] ?? 0),
            'discount_amount_tax_excl' => (float) ($product['discount_amount_tax_excl'] ?? 0),
            'discount_percent' => (float) ($product['discount_percent'] ?? 0),
            'product_url' => (string) ($product['product_url'] ?? '/products/'.$productId),
            'image_url' => (string) ($product['image_url'] ?? ''),
        ];
    }

    /**
     * @param  array<string, mixed>  $product
     * @return array<string, mixed>
     */
    private function transformSearchProduct(array $product): array
    {
        $productId = (int) ($product['id'] ?? 0);

        /** @var list<string> $categories */
        $categories = [];

        foreach ((array) ($product['categories'] ?? []) as $categoryValue) {
            if (! is_scalar($categoryValue)) {
                continue;
            }

            $category = trim((string) $categoryValue);

            if ($category === '') {
                continue;
            }

            $categories[] = $category;
        }

        return [
            'doc_id' => (string) ($product['doc_id'] ?? '0-'.$productId),
            'id' => $productId,
            'name' => (string) ($product['name'] ?? ''),
            'link' => (string) ($product['link'] ?? '/products/'.$productId),
            'image' => (string) ($product['image'] ?? ''),
            'reference' => (string) ($product['reference'] ?? ''),
            'ean13' => (string) ($product['ean13'] ?? ''),
            'price' => (float) ($product['price'] ?? ($product['current_price_tax_excl'] ?? 0)),
            'quantity' => (int) ($product['quantity'] ?? 0),
            'active' => (bool) ($product['active'] ?? false),
            'description_short' => (string) ($product['description_short'] ?? ''),
            'description' => (string) ($product['description'] ?? ''),
            'categories' => $categories,
            'category' => (string) ($product['category'] ?? ''),
            'brand' => (string) ($product['brand'] ?? ($product['manufacturer_name'] ?? '')),
            'contents' => (string) ($product['contents'] ?? ''),
            'updated_at' => (string) ($product['updated_at_iso'] ?? ''),
            'price_original' => (float) ($product['price_original'] ?? ($product['original_price_tax_excl'] ?? 0)),
            'sync_run_id' => (string) ($product['sync_run_id'] ?? ''),
        ];
    }

    private function resolveHistoryIdentifier(Request $request): string
    {
        $historyKey = trim((string) $request->input('history_key', ''));

        if ($historyKey !== '') {
            return 'history_key:'.$historyKey;
        }

        $ipAddress = trim((string) ($request->ip() ?? ''));

        return 'ip:'.($ipAddress !== '' ? $ipAddress : 'unknown');
    }

    /**
     * @param  array<string, mixed>  $product
     */
    private function isActive(array $product): bool
    {
        return (bool) ($product['active'] ?? false);
    }
}
