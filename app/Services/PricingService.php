<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PricingService
{
    public function __construct(private TenantPrestaShopConnection $tenantPrestaShopConnection) {}

    /**
     * @return array{
     *     original_price_tax_excl:float,
     *     current_price_tax_excl:float,
     *     original_price_tax_incl:float,
     *     current_price_tax_incl:float,
     *     discount_amount_tax_excl:float,
     *     discount_percent:float
     * }
     */
    public function computeForProduct(int $productId): array
    {
        $productTable = $this->tenantPrestaShopConnection->table('product');
        $specificPriceTable = $this->tenantPrestaShopConnection->table('specific_price');

        /** @var object{price:float|int|string}|null $product */
        $product = DB::connection('tenant_ps')
            ->table($productTable)
            ->where('id_product', $productId)
            ->first(['price']);

        if ($product === null) {
            throw new RuntimeException('Product not found in PrestaShop database.');
        }

        $originalPrice = round((float) $product->price, 6);
        $now = Carbon::now()->format('Y-m-d H:i:s');

        /** @var list<object{price:float|int|string,reduction:float|int|string,reduction_type:string,from:string,to:string}> $specificPrices */
        $specificPrices = DB::connection('tenant_ps')
            ->table($specificPriceTable)
            ->where('id_product', $productId)
            ->where('id_product_attribute', 0)
            ->where(function ($query) use ($now): void {
                $query->where('from', '0000-00-00 00:00:00')
                    ->orWhere('from', '<=', $now);
            })
            ->where(function ($query) use ($now): void {
                $query->where('to', '0000-00-00 00:00:00')
                    ->orWhere('to', '>=', $now);
            })
            ->get(['price', 'reduction', 'reduction_type', 'from', 'to'])
            ->all();

        $currentPrice = $this->resolveCurrentPriceFromSpecificPrices($originalPrice, $specificPrices);
        $vatRate = $this->resolveVatRateForProduct($productId);

        $discountAmount = round(max(0, $originalPrice - $currentPrice), 6);
        $discountPercent = $originalPrice > 0
            ? round(($discountAmount / $originalPrice) * 100, 2)
            : 0.0;

        return [
            'original_price_tax_excl' => $originalPrice,
            'current_price_tax_excl' => $currentPrice,
            'original_price_tax_incl' => $this->computeTaxIncl($originalPrice, $vatRate),
            'current_price_tax_incl' => $this->computeTaxIncl($currentPrice, $vatRate),
            'discount_amount_tax_excl' => $discountAmount,
            'discount_percent' => $discountPercent,
        ];
    }

    public function computeTaxIncl(float $priceExcl, float $vatRate): float
    {
        $this->assertSupportedVatRate($vatRate);

        return round($priceExcl * (1 + ($vatRate / 100)), 6);
    }

    public function resolveVatRateForProduct(int $productId): float
    {
        $productTable = $this->tenantPrestaShopConnection->table('product');
        $countryTable = $this->tenantPrestaShopConnection->table('country');
        $taxRuleTable = $this->tenantPrestaShopConnection->table('tax_rule');
        $taxTable = $this->tenantPrestaShopConnection->table('tax');

        /** @var object{id_tax_rules_group:int|string|null}|null $product */
        $product = DB::connection('tenant_ps')
            ->table($productTable)
            ->where('id_product', $productId)
            ->first(['id_tax_rules_group']);

        if ($product === null) {
            throw new RuntimeException('Product not found in PrestaShop database.');
        }

        $taxRulesGroupId = (int) ($product->id_tax_rules_group ?? 0);

        if ($taxRulesGroupId < 1) {
            throw new RuntimeException('Unable to resolve VAT rate: product has no tax rules group.');
        }

        $nlCountryId = DB::connection('tenant_ps')
            ->table($countryTable)
            ->where('iso_code', 'NL')
            ->value('id_country');

        $taxRuleQuery = DB::connection('tenant_ps')
            ->table($taxRuleTable.' as tr')
            ->join($taxTable.' as t', 't.id_tax', '=', 'tr.id_tax')
            ->where('tr.id_tax_rules_group', $taxRulesGroupId)
            ->where('t.active', 1);

        if (is_numeric($nlCountryId)) {
            $taxRuleQuery->whereIn('tr.id_country', [0, (int) $nlCountryId]);
        }

        /** @var list<object{id_country:int|string,rate:float|int|string}> $rules */
        $rules = $taxRuleQuery
            ->orderByRaw('CASE WHEN tr.id_country = 0 THEN 1 ELSE 0 END ASC')
            ->get(['tr.id_country', 't.rate'])
            ->all();

        if ($rules === []) {
            throw new RuntimeException('Unable to resolve VAT rate: no applicable tax rule found.');
        }

        $resolvedRate = (float) $rules[0]->rate;

        if (abs($resolvedRate - 21.0) < 0.01) {
            return 21.0;
        }

        if (abs($resolvedRate - 9.0) < 0.01) {
            return 9.0;
        }

        throw new RuntimeException('Unsupported VAT rate. Only 21% and 9% are supported.');
    }

    /**
     * @param  iterable<object{price:float|int|string,reduction:float|int|string,reduction_type:string}|array{price:float|int|string,reduction:float|int|string,reduction_type:string}>  $specificPrices
     */
    public function resolveCurrentPriceFromSpecificPrices(float $originalPrice, iterable $specificPrices): float
    {
        $bestPrice = round($originalPrice, 6);

        foreach ($specificPrices as $specificPrice) {
            $price = (float) data_get($specificPrice, 'price', -1);
            $reduction = (float) data_get($specificPrice, 'reduction', 0);
            $reductionType = (string) data_get($specificPrice, 'reduction_type', '');

            $candidatePrice = $price >= 0 ? $price : $originalPrice;

            if ($reductionType === 'percentage') {
                $candidatePrice *= (1 - $reduction);
            } elseif ($reductionType === 'amount') {
                $candidatePrice -= $reduction;
            }

            $candidatePrice = round(max(0, $candidatePrice), 6);

            if ($candidatePrice < $bestPrice) {
                $bestPrice = $candidatePrice;
            }
        }

        return $bestPrice;
    }

    private function assertSupportedVatRate(float $vatRate): void
    {
        if (abs($vatRate - 21.0) < 0.01 || abs($vatRate - 9.0) < 0.01) {
            return;
        }

        throw new RuntimeException('Unsupported VAT rate. Only 21% and 9% are supported.');
    }
}
