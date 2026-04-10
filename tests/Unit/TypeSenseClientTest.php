<?php

use App\Services\TypeSenseClient;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    config()->set('services.typesense.url', 'http://typesense.test:8108');
    config()->set('services.typesense.key', 'typesense-key');
    config()->set('services.typesense.timeout', 10);
});

it('does not create a collection when it already exists', function () {
    Http::fake([
        'http://typesense.test:8108/collections/products__12' => Http::response([], 200),
    ]);

    app(TypeSenseClient::class)->ensureCollectionExists(12);

    Http::assertSentCount(1);
    Http::assertSent(function (Request $request): bool {
        return $request->method() === 'GET'
            && $request->url() === 'http://typesense.test:8108/collections/products__12';
    });
});

it('creates a collection with the expected schema when it is missing', function () {
    Http::fake([
        'http://typesense.test:8108/collections/products__33' => Http::response([], 404),
        'http://typesense.test:8108/collections' => Http::response([], 201),
    ]);

    app(TypeSenseClient::class)->ensureCollectionExists(33);

    Http::assertSent(function (Request $request): bool {
        if ($request->method() !== 'POST' || $request->url() !== 'http://typesense.test:8108/collections') {
            return false;
        }

        $payload = $request->data();
        $fields = collect($payload['fields'] ?? [])->keyBy('name');

        return ($payload['name'] ?? null) === 'products__33'
            && data_get($fields, 'id.type') === 'string'
            && data_get($fields, 'brand.facet') === true
            && data_get($fields, 'category.facet') === true
            && data_get($fields, 'updated_at.type') === 'int64';
    });
});

it('upserts a product document in the tenant collection', function () {
    Http::fake([
        'http://typesense.test:8108/collections/products__9/documents?action=upsert' => Http::response([], 201),
    ]);

    app(TypeSenseClient::class)->upsertProductDoc(9, [
        'id' => '123',
        'name' => 'Product',
        'updated_at' => 1_739_951_337,
    ]);

    Http::assertSent(function (Request $request): bool {
        $payload = $request->data();

        return $request->method() === 'POST'
            && $request->url() === 'http://typesense.test:8108/collections/products__9/documents?action=upsert'
            && ($payload['id'] ?? null) === '123';
    });
});

it('deletes a product document from the tenant collection', function () {
    Http::fake([
        'http://typesense.test:8108/collections/products__9/documents/321' => Http::response([], 200),
    ]);

    app(TypeSenseClient::class)->deleteProductDoc(9, 321);

    Http::assertSent(function (Request $request): bool {
        return $request->method() === 'DELETE'
            && $request->url() === 'http://typesense.test:8108/collections/products__9/documents/321';
    });
});

it('lists product document ids for a tenant collection', function () {
    Http::fake([
        'http://typesense.test:8108/collections/products__9/documents/search*' => Http::sequence()
            ->push([
                'found' => 3,
                'hits' => [
                    ['document' => ['id' => '1']],
                    ['document' => ['id' => '2']],
                ],
            ], 200)
            ->push([
                'found' => 3,
                'hits' => [
                    ['document' => ['id' => '3']],
                ],
            ], 200),
    ]);

    $ids = app(TypeSenseClient::class)->listProductDocIds(9, 2);

    expect($ids)->toBe(['1', '2', '3']);

    Http::assertSent(function (Request $request): bool {
        if ($request->method() !== 'GET' || ! str_starts_with($request->url(), 'http://typesense.test:8108/collections/products__9/documents/search')) {
            return false;
        }

        return ($request['q'] ?? null) === '*'
            && ($request['query_by'] ?? null) === 'name';
    });
});

it('includes response body when listing document ids fails', function () {
    Http::fake([
        'http://typesense.test:8108/collections/products__9/documents/search*' => Http::response([
            'message' => 'Could not find a field named `id` in the schema.',
        ], 400),
    ]);

    try {
        app(TypeSenseClient::class)->listProductDocIds(9, 2);
    } catch (RuntimeException $exception) {
        expect($exception->getMessage())
            ->toContain('Failed listing TypeSense product documents. Status: 400')
            ->toContain('Body:')
            ->toContain('Could not find a field named `id` in the schema.');

        return;
    }

    $this->fail('Expected RuntimeException was not thrown.');
});

it('searches product documents with facets', function () {
    Http::fake([
        'http://typesense.test:8108/collections/products__9/documents/search*' => Http::response([
            'found' => 1,
            'hits' => [
                [
                    'document' => [
                        'id' => '100',
                        'name' => 'Product',
                    ],
                ],
            ],
            'facet_counts' => [
                [
                    'field_name' => 'brand',
                    'counts' => [
                        ['value' => 'AOV', 'count' => 3],
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

    $results = app(TypeSenseClient::class)->searchProductDocsWithFacets(
        tenantId: 9,
        query: 'aov',
        page: 2,
        perPage: 10,
        filters: [
            'category' => 'Mineralen',
            'brand' => 'AOV',
        ],
    );

    expect($results['total'])->toBe(1)
        ->and($results['data'])->toHaveCount(1)
        ->and($results['facets']['brand'])->toBe(['AOV' => 3])
        ->and($results['facets']['category'])->toBe(['Mineralen' => 1]);

    Http::assertSent(function (Request $request): bool {
        if ($request->method() !== 'GET' || ! str_contains($request->url(), '/documents/search')) {
            return false;
        }

        return ($request['q'] ?? null) === 'aov'
            && ($request['facet_by'] ?? null) === 'brand,category'
            && (int) ($request['page'] ?? 0) === 2
            && (int) ($request['per_page'] ?? 0) === 10
            && is_string($request['filter_by'] ?? null)
            && str_contains((string) $request['filter_by'], 'active:=true')
            && str_contains((string) $request['filter_by'], 'brand:=')
            && str_contains((string) $request['filter_by'], 'category:=');
    });
});
