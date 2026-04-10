<?php

use App\Models\ApiToken;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config()->set('services.typesense.url', 'http://typesense.test:8108');
    config()->set('services.typesense.key', 'typesense-key');
    config()->set('services.typesense.timeout', 10);
    Cache::flush();
});

it('requires tenant token authentication', function () {
    $response = getJson('/api/v1/products');

    $response->assertUnauthorized()
        ->assertJsonPath('message', __('saas.auth.missing_tenant_token'));
});

it('requires tenant token authentication for product search', function () {
    $response = getJson('/api/v1/products/search');

    $response->assertUnauthorized()
        ->assertJsonPath('message', __('saas.auth.missing_tenant_token'));
});

it('returns only active products from list results', function () {
    $tenant = Tenant::factory()->create();
    [, $plainTextToken] = ApiToken::issue($tenant->id, 'Customer API Token');

    Http::fake([
        'http://typesense.test:8108/collections/products__'.$tenant->id.'/documents/search*' => Http::response([
            'found' => 2,
            'page' => 1,
            'hits' => [
                [
                    'document' => [
                        'id' => '100',
                        'name' => 'Active product',
                        'reference' => 'REF-100',
                        'manufacturer_name' => 'Acme',
                        'active' => true,
                        'original_price_tax_excl' => 100.0,
                        'current_price_tax_excl' => 90.0,
                        'original_price_tax_incl' => 121.0,
                        'current_price_tax_incl' => 108.9,
                        'discount_amount_tax_excl' => 10.0,
                        'discount_percent' => 10.0,
                        'product_url' => '/products/100',
                        'image_url' => 'https://cdn.example.test/100.jpg',
                    ],
                ],
                [
                    'document' => [
                        'id' => '200',
                        'name' => 'Inactive product',
                        'reference' => 'REF-200',
                        'manufacturer_name' => 'Acme',
                        'active' => false,
                        'original_price_tax_excl' => 100.0,
                        'current_price_tax_excl' => 100.0,
                        'original_price_tax_incl' => 121.0,
                        'current_price_tax_incl' => 121.0,
                        'discount_amount_tax_excl' => 0.0,
                        'discount_percent' => 0.0,
                        'product_url' => '/products/200',
                        'image_url' => 'https://cdn.example.test/200.jpg',
                    ],
                ],
            ],
        ], 200),
    ]);

    $response = getJson('/api/v1/products', [
        'Authorization' => 'Bearer '.$plainTextToken,
    ]);

    $response->assertSuccessful()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', 100)
        ->assertJsonMissingPath('data.1.id');
});

it('supports basic search query and pagination', function () {
    $tenant = Tenant::factory()->create();
    [, $plainTextToken] = ApiToken::issue($tenant->id, 'Customer API Token');

    Http::fake([
        'http://typesense.test:8108/collections/products__'.$tenant->id.'/documents/search*' => Http::response([
            'found' => 25,
            'page' => 2,
            'hits' => [
                [
                    'document' => [
                        'id' => '300',
                        'name' => 'Red Shoes',
                        'reference' => 'SHO-300',
                        'manufacturer_name' => 'Example Brand',
                        'active' => true,
                        'original_price_tax_excl' => 50.0,
                        'current_price_tax_excl' => 45.0,
                        'original_price_tax_incl' => 60.5,
                        'current_price_tax_incl' => 54.45,
                        'discount_amount_tax_excl' => 5.0,
                        'discount_percent' => 10.0,
                        'product_url' => '/products/300',
                        'image_url' => 'https://cdn.example.test/300.jpg',
                    ],
                ],
            ],
        ], 200),
    ]);

    $response = getJson('/api/v1/products?q=shoe&page=2&per_page=10', [
        'Authorization' => 'Bearer '.$plainTextToken,
    ]);

    $response->assertSuccessful()
        ->assertJsonPath('meta.page', 2)
        ->assertJsonPath('meta.per_page', 10)
        ->assertJsonPath('meta.total', 25)
        ->assertJsonPath('data.0.id', 300)
        ->assertJsonPath('data.0.name', 'Red Shoes')
        ->assertJsonPath('data.0.manufacturer', 'Example Brand')
        ->assertJsonPath('data.0.current_price_tax_excl', 45);

    Http::assertSent(function (Request $request): bool {
        if ($request->method() !== 'GET') {
            return false;
        }

        if (! str_contains($request->url(), '/documents/search')) {
            return false;
        }

        $payload = $request->data();

        return ($payload['q'] ?? null) === 'shoe'
            && (int) ($payload['page'] ?? 0) === 2
            && (int) ($payload['per_page'] ?? 0) === 10
            && is_string($payload['filter_by'] ?? null)
            && str_contains((string) $payload['filter_by'], 'active:=true');
    });
});

it('returns search payload with facets and strict result fields', function () {
    $tenant = Tenant::factory()->create();
    [, $plainTextToken] = ApiToken::issue($tenant->id, 'Customer API Token');

    Http::fake([
        'http://typesense.test:8108/collections/products__'.$tenant->id.'/documents/search*' => Http::response([
            'found' => 1,
            'hits' => [
                [
                    'document' => [
                        'id' => '4569',
                        'doc_id' => $tenant->id.'-4569',
                        'name' => 'AOV 580 Jodium nascent 150mcg (15ml)',
                        'link' => '/aov-580-jodium-nascent-150mcg-15ml',
                        'image' => '',
                        'reference' => '564528',
                        'ean13' => '8715687605807',
                        'price' => 14.36,
                        'quantity' => 37,
                        'active' => true,
                        'description_short' => 'Short',
                        'description' => 'Long',
                        'categories' => ['AOV', 'Mineralen'],
                        'category' => 'Mineralen',
                        'brand' => 'AOV',
                        'contents' => '15ml',
                        'updated_at_iso' => '2026-02-12 19:27:10',
                        'price_original' => 19.95,
                        'sync_run_id' => '1775786606',
                    ],
                ],
            ],
            'facet_counts' => [
                [
                    'field_name' => 'brand',
                    'counts' => [
                        ['value' => 'AOV', 'count' => 1],
                    ],
                ],
                [
                    'field_name' => 'category',
                    'counts' => [
                        ['value' => 'Mineralen', 'count' => 1],
                    ],
                ],
            ],
        ], 200),
    ]);

    $response = getJson('/api/v1/products/search?q=jodium&brand=AOV&history_key=user-1', [
        'Authorization' => 'Bearer '.$plainTextToken,
    ]);

    $response->assertSuccessful()
        ->assertJsonPath('facets.brand.AOV', 1)
        ->assertJsonPath('facets.category.Mineralen', 1)
        ->assertJsonPath('total', 1)
        ->assertJsonPath('history.0', 'jodium')
        ->assertJsonPath('results.0.doc_id', $tenant->id.'-4569')
        ->assertJsonPath('results.0.id', 4569)
        ->assertJsonPath('results.0.name', 'AOV 580 Jodium nascent 150mcg (15ml)')
        ->assertJsonPath('results.0.link', '/aov-580-jodium-nascent-150mcg-15ml')
        ->assertJsonPath('results.0.image', '')
        ->assertJsonPath('results.0.reference', '564528')
        ->assertJsonPath('results.0.ean13', '8715687605807')
        ->assertJsonPath('results.0.price', 14.36)
        ->assertJsonPath('results.0.quantity', 37)
        ->assertJsonPath('results.0.active', true)
        ->assertJsonPath('results.0.description_short', 'Short')
        ->assertJsonPath('results.0.description', 'Long')
        ->assertJsonPath('results.0.categories.0', 'AOV')
        ->assertJsonPath('results.0.category', 'Mineralen')
        ->assertJsonPath('results.0.brand', 'AOV')
        ->assertJsonPath('results.0.contents', '15ml')
        ->assertJsonPath('results.0.updated_at', '2026-02-12 19:27:10')
        ->assertJsonPath('results.0.price_original', 19.95)
        ->assertJsonPath('results.0.sync_run_id', '1775786606');

    Http::assertSent(function (Request $request): bool {
        if ($request->method() !== 'GET') {
            return false;
        }

        if (! str_contains($request->url(), '/documents/search')) {
            return false;
        }

        return ($request['facet_by'] ?? null) === 'brand,category'
            && str_contains((string) ($request['filter_by'] ?? ''), 'brand:=');
    });
});

it('keeps only the last 10 unique history entries per history_key', function () {
    $tenant = Tenant::factory()->create();
    [, $plainTextToken] = ApiToken::issue($tenant->id, 'Customer API Token');

    Http::fake([
        'http://typesense.test:8108/collections/products__'.$tenant->id.'/documents/search*' => Http::response([
            'found' => 0,
            'hits' => [],
            'facet_counts' => [],
        ], 200),
    ]);

    foreach (range(1, 11) as $index) {
        getJson('/api/v1/products/search?q=query-'.$index.'&history_key=history-user', [
            'Authorization' => 'Bearer '.$plainTextToken,
        ])->assertSuccessful();
    }

    $response = getJson('/api/v1/products/search?q=query-5&history_key=history-user', [
        'Authorization' => 'Bearer '.$plainTextToken,
    ]);

    $response->assertSuccessful()
        ->assertJsonCount(10, 'history')
        ->assertJsonPath('history.0', 'query-5')
        ->assertJsonMissing(['history' => ['query-1']]);
});

it('falls back to requester ip for search history when history_key is missing', function () {
    $tenant = Tenant::factory()->create();
    [, $plainTextToken] = ApiToken::issue($tenant->id, 'Customer API Token');

    Http::fake([
        'http://typesense.test:8108/collections/products__'.$tenant->id.'/documents/search*' => Http::response([
            'found' => 0,
            'hits' => [],
            'facet_counts' => [],
        ], 200),
    ]);

    getJson('/api/v1/products/search?q=first', [
        'Authorization' => 'Bearer '.$plainTextToken,
        'REMOTE_ADDR' => '203.0.113.12',
    ])->assertSuccessful();

    $response = getJson('/api/v1/products/search?q=second', [
        'Authorization' => 'Bearer '.$plainTextToken,
        'REMOTE_ADDR' => '203.0.113.12',
    ]);

    $response->assertSuccessful()
        ->assertJsonPath('history.0', 'second')
        ->assertJsonPath('history.1', 'first');
});
