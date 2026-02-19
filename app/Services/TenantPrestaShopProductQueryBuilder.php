<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TenantPrestaShopProductQueryBuilder
{
    public function __construct(private TenantPrestaShopConnection $tenantPrestaShopConnection) {}

    /**
     * Index requirements (PrestaShop tenant DB, not managed by our migrations):
     * - product: PRIMARY(id_product), INDEX(id_manufacturer), INDEX(active)
     * - product_lang: INDEX(id_product, id_lang)
     * - stock_available: INDEX(id_product, id_product_attribute)
     * - specific_price: INDEX(id_product, id_product_attribute), INDEX(`from`), INDEX(`to`)
     *
     * @param  Builder<\Illuminate\Database\Eloquent\Model>  $baseQuery
     * @return Builder<\Illuminate\Database\Eloquent\Model>
     */
    public function buildBaseQuery(Builder $baseQuery): Builder
    {
        $productTable = $this->tenantPrestaShopConnection->table('product');
        $productLangTable = $this->tenantPrestaShopConnection->table('product_lang');
        $manufacturerTable = $this->tenantPrestaShopConnection->table('manufacturer');
        $stockAvailableTable = $this->tenantPrestaShopConnection->table('stock_available');
        $specificPriceTable = $this->tenantPrestaShopConnection->table('specific_price');
        $now = now()->format('Y-m-d H:i:s');

        $nameSubquery = DB::connection('tenant_ps')
            ->table($productLangTable.' as pl')
            ->select('pl.name')
            ->whereColumn('pl.id_product', 'p.id_product')
            ->orderBy('pl.id_lang')
            ->limit(1);

        $stockSubquery = DB::connection('tenant_ps')
            ->table($stockAvailableTable.' as sa')
            ->selectRaw('sa.id_product, COALESCE(SUM(sa.quantity), 0) as stock_qty')
            ->where('sa.id_product_attribute', 0)
            ->groupBy('sa.id_product');

        $currentPriceSubquery = DB::connection('tenant_ps')
            ->table($productTable.' as p2')
            ->leftJoin($specificPriceTable.' as sp', function ($join) use ($now): void {
                $join->on('sp.id_product', '=', 'p2.id_product')
                    ->where('sp.id_product_attribute', 0)
                    ->where(function ($query) use ($now): void {
                        $query->where('sp.from', '0000-00-00 00:00:00')
                            ->orWhere('sp.from', '<=', $now);
                    })
                    ->where(function ($query) use ($now): void {
                        $query->where('sp.to', '0000-00-00 00:00:00')
                            ->orWhere('sp.to', '>=', $now);
                    });
            })
            ->selectRaw(
                "p2.id_product, ROUND(IFNULL(MIN(CASE
                    WHEN sp.reduction_type = 'percentage' THEN GREATEST(p2.price * (1 - sp.reduction), 0)
                    WHEN sp.reduction_type = 'amount' THEN GREATEST(p2.price - sp.reduction, 0)
                    ELSE p2.price
                END), p2.price), 6) as current_price_tax_excl"
            )
            ->groupBy('p2.id_product', 'p2.price');

        return $baseQuery
            ->from($productTable.' as p')
            ->leftJoin($manufacturerTable.' as m', 'm.id_manufacturer', '=', 'p.id_manufacturer')
            ->leftJoinSub($stockSubquery, 'stock', 'stock.id_product', '=', 'p.id_product')
            ->leftJoinSub($currentPriceSubquery, 'current_price', 'current_price.id_product', '=', 'p.id_product')
            ->select([
                'p.id_product',
                'p.id_manufacturer',
                'p.reference',
                'p.active',
                DB::raw("COALESCE(m.name, '') as manufacturer"),
                DB::raw('ROUND(p.price, 6) as original_price_tax_excl'),
                DB::raw('ROUND(p.price, 6) as original_price_tax_incl'),
                DB::raw('COALESCE(stock.stock_qty, 0) as stock_qty'),
                DB::raw('COALESCE(current_price.current_price_tax_excl, ROUND(p.price, 6)) as current_price_tax_excl'),
                DB::raw('COALESCE(current_price.current_price_tax_excl, ROUND(p.price, 6)) as current_price_tax_incl'),
            ])
            ->selectSub($nameSubquery, 'name');
    }
}
