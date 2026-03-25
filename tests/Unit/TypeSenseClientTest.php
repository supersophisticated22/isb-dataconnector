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

        return ($payload['name'] ?? null) === 'products__33'
            && ($payload['fields'][0]['name'] ?? null) === 'id'
            && ($payload['fields'][0]['type'] ?? null) === 'string'
            && ($payload['fields'][14]['name'] ?? null) === 'updated_at'
            && ($payload['fields'][14]['type'] ?? null) === 'int64';
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
});
