<?php

use App\Models\ApiToken;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config()->set('services.typesense.url', 'http://typesense.test:8108');
    config()->set('services.typesense.key', 'typesense-key');
    config()->set('services.typesense.timeout', 10);
});

it('requires tenant token authentication', function () {
    $response = getJson('/api/v1/products');

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
