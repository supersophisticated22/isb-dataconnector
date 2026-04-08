<?php

use App\Services\PricingService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    config()->set('database.connections.tenant_ps', [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
        'foreign_key_constraints' => false,
    ]);

    DB::purge('tenant_ps');
    DB::reconnect('tenant_ps');

    Schema::connection('tenant_ps')->create('ps_product', function (Blueprint $table): void {
        $table->integer('id_product')->primary();
        $table->decimal('price', 20, 6);
        $table->integer('id_tax_rules_group')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_specific_price', function (Blueprint $table): void {
        $table->integer('id_specific_price')->primary();
        $table->integer('id_product');
        $table->integer('id_product_attribute')->default(0);
        $table->decimal('price', 20, 6)->default(-1);
        $table->decimal('reduction', 20, 6)->default(0);
        $table->string('reduction_type')->default('amount');
        $table->dateTime('from');
        $table->dateTime('to');
    });

    Schema::connection('tenant_ps')->create('ps_country', function (Blueprint $table): void {
        $table->integer('id_country')->primary();
        $table->string('iso_code', 2);
    });

    Schema::connection('tenant_ps')->create('ps_tax', function (Blueprint $table): void {
        $table->integer('id_tax')->primary();
        $table->decimal('rate', 10, 4);
        $table->boolean('active')->default(true);
    });

    Schema::connection('tenant_ps')->create('ps_tax_rule', function (Blueprint $table): void {
        $table->integer('id_tax_rule')->primary();
        $table->integer('id_tax_rules_group');
        $table->integer('id_country')->default(0);
        $table->integer('id_tax');
    });
});

it('resolves the best specific price across percent amount and fixed price scenarios', function () {
    $service = app(PricingService::class);

    $current = $service->resolveCurrentPriceFromSpecificPrices(100.0, [
        ['price' => -1, 'reduction' => 0.10, 'reduction_type' => 'percentage'],
        ['price' => -1, 'reduction' => 15.0, 'reduction_type' => 'amount'],
        ['price' => 70.0, 'reduction' => 0.0, 'reduction_type' => 'amount'],
        ['price' => 80.0, 'reduction' => 0.50, 'reduction_type' => 'percentage'],
    ]);

    expect($current)->toBe(40.0);
});

it('returns original pricing when no specific price applies', function () {
    seedTaxTables(rate: 21.0);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 1,
        'price' => 100,
        'id_tax_rules_group' => 1,
    ]);

    $payload = app(PricingService::class)->computeForProduct(1);

    expect($payload)->toBe([
        'original_price_tax_excl' => 100.0,
        'current_price_tax_excl' => 100.0,
        'original_price_tax_incl' => 121.0,
        'current_price_tax_incl' => 121.0,
        'discount_amount_tax_excl' => 0.0,
        'discount_percent' => 0.0,
    ]);
});

it('uses only date-valid product-level specific prices to determine current price', function () {
    seedTaxTables(rate: 21.0);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 2,
        'price' => 100,
        'id_tax_rules_group' => 1,
    ]);

    $now = Carbon::now();

    DB::connection('tenant_ps')->table('ps_specific_price')->insert([
        [
            'id_specific_price' => 1,
            'id_product' => 2,
            'id_product_attribute' => 0,
            'price' => -1,
            'reduction' => 0.10,
            'reduction_type' => 'percentage',
            'from' => $now->copy()->subDay()->format('Y-m-d H:i:s'),
            'to' => $now->copy()->addDay()->format('Y-m-d H:i:s'),
        ],
        [
            'id_specific_price' => 2,
            'id_product' => 2,
            'id_product_attribute' => 0,
            'price' => 80,
            'reduction' => 5,
            'reduction_type' => 'amount',
            'from' => $now->copy()->subDay()->format('Y-m-d H:i:s'),
            'to' => $now->copy()->addDay()->format('Y-m-d H:i:s'),
        ],
        [
            'id_specific_price' => 3,
            'id_product' => 2,
            'id_product_attribute' => 0,
            'price' => 50,
            'reduction' => 0,
            'reduction_type' => 'amount',
            'from' => $now->copy()->addDay()->format('Y-m-d H:i:s'),
            'to' => $now->copy()->addDays(2)->format('Y-m-d H:i:s'),
        ],
        [
            'id_specific_price' => 4,
            'id_product' => 2,
            'id_product_attribute' => 0,
            'price' => 30,
            'reduction' => 0,
            'reduction_type' => 'amount',
            'from' => $now->copy()->subDays(3)->format('Y-m-d H:i:s'),
            'to' => $now->copy()->subDay()->format('Y-m-d H:i:s'),
        ],
        [
            'id_specific_price' => 5,
            'id_product' => 2,
            'id_product_attribute' => 1,
            'price' => 10,
            'reduction' => 0,
            'reduction_type' => 'amount',
            'from' => $now->copy()->subDay()->format('Y-m-d H:i:s'),
            'to' => $now->copy()->addDay()->format('Y-m-d H:i:s'),
        ],
    ]);

    $payload = app(PricingService::class)->computeForProduct(2);

    expect($payload['current_price_tax_excl'])->toBe(75.0)
        ->and($payload['discount_amount_tax_excl'])->toBe(25.0)
        ->and($payload['discount_percent'])->toBe(25.0)
        ->and($payload['current_price_tax_incl'])->toBe(90.75);
});

it('resolves the reduced NL VAT rate and rejects unsupported rates', function () {
    seedTaxTables(rate: 9.0);

    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => 3,
        'price' => 50,
        'id_tax_rules_group' => 1,
    ]);

    $service = app(PricingService::class);

    expect($service->resolveVatRateForProduct(3))->toBe(9.0)
        ->and($service->computeTaxIncl(50.0, 9.0))->toBe(54.5);

    expect(fn () => $service->computeTaxIncl(50.0, 6.0))
        ->toThrow(RuntimeException::class);
});

function seedTaxTables(float $rate): void
{
    DB::connection('tenant_ps')->table('ps_country')->insert([
        'id_country' => 99,
        'iso_code' => 'NL',
    ]);

    DB::connection('tenant_ps')->table('ps_tax')->insert([
        'id_tax' => 1,
        'rate' => $rate,
        'active' => 1,
    ]);

    DB::connection('tenant_ps')->table('ps_tax_rule')->insert([
        'id_tax_rule' => 1,
        'id_tax_rules_group' => 1,
        'id_country' => 99,
        'id_tax' => 1,
    ]);
}
