<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ListProductsRequest;
use App\Services\TenantContext;
use App\Services\TypeSenseClient;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        private TypeSenseClient $typeSenseClient,
        private TenantContext $tenantContext,
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

    private function resolveTenantId(): int
    {
        return $this->tenantContext->tenantId() ?? (int) request()->attributes->get('tenant_id');
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
     */
    private function isActive(array $product): bool
    {
        return (bool) ($product['active'] ?? false);
    }
}
