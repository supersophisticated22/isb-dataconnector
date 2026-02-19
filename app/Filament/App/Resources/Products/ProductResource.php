<?php

namespace App\Filament\App\Resources\Products;

use App\Filament\App\Resources\Products\Pages\ListProducts;
use App\Filament\App\Resources\Products\Pages\ViewProduct;
use App\Filament\App\Resources\Products\RelationManagers\SpecificPricesRelationManager;
use App\Filament\App\Resources\Products\Schemas\ProductInfolist;
use App\Filament\App\Resources\Products\Tables\ProductsTable;
use App\Models\TenantPrestaShopProduct;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopConnection;
use App\Services\TypeSenseClient;
use BackedEnum;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Throwable;

class ProductResource extends Resource
{
    protected static ?string $model = TenantPrestaShopProduct::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 30;

    public static function infolist(Schema $schema): Schema
    {
        return ProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getNavigationLabel(): string
    {
        return __('saas.resources.products.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('saas.resources.products.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('saas.resources.products.plural_model_label');
    }

    public static function canViewAny(): bool
    {
        return Gate::allows('view-tenant-products');
    }

    public static function canView(mixed $record): bool
    {
        return Gate::allows('view-tenant-products');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(mixed $record): bool
    {
        return false;
    }

    public static function canDelete(mixed $record): bool
    {
        return false;
    }

    /**
     * @return array<int, class-string>
     */
    public static function getRelations(): array
    {
        return [
            SpecificPricesRelationManager::class,
        ];
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'view' => ViewProduct::route('/{record}'),
        ];
    }

    /**
     * @return Builder<\Illuminate\Database\Eloquent\Model>
     */
    public static function getEloquentQuery(): Builder
    {
        $connection = app(TenantPrestaShopConnection::class);
        $productTable = $connection->table('product');
        $productLangTable = $connection->table('product_lang');
        $manufacturerTable = $connection->table('manufacturer');
        $stockAvailableTable = $connection->table('stock_available');
        $specificPriceTable = $connection->table('specific_price');

        $nameSubquery = DB::connection('tenant_ps')
            ->table($productLangTable.' as pl')
            ->select('pl.name')
            ->whereColumn('pl.id_product', 'p.id_product')
            ->orderBy('pl.id_lang')
            ->limit(1);

        $stockSubquery = DB::connection('tenant_ps')
            ->table($stockAvailableTable.' as sa')
            ->selectRaw('COALESCE(SUM(sa.quantity), 0)')
            ->whereColumn('sa.id_product', 'p.id_product')
            ->where('sa.id_product_attribute', 0);

        $currentPriceSubquery = DB::connection('tenant_ps')
            ->table($specificPriceTable.' as sp')
            ->selectRaw(
                "ROUND(IFNULL(MIN(CASE
                    WHEN sp.reduction_type = 'percentage' THEN GREATEST(p.price * (1 - sp.reduction), 0)
                    WHEN sp.reduction_type = 'amount' THEN GREATEST(p.price - sp.reduction, 0)
                    ELSE p.price
                END), p.price), 6)"
            )
            ->whereColumn('sp.id_product', 'p.id_product')
            ->where('sp.id_product_attribute', 0)
            ->where(function ($query): void {
                $query->where('sp.from', '0000-00-00 00:00:00')
                    ->orWhere('sp.from', '<=', now()->format('Y-m-d H:i:s'));
            })
            ->where(function ($query): void {
                $query->where('sp.to', '0000-00-00 00:00:00')
                    ->orWhere('sp.to', '>=', now()->format('Y-m-d H:i:s'));
            });

        $query = parent::getEloquentQuery()
            ->from($productTable.' as p')
            ->leftJoin($manufacturerTable.' as m', 'm.id_manufacturer', '=', 'p.id_manufacturer')
            ->select([
                'p.id_product',
                'p.reference',
                'p.active',
                DB::raw("COALESCE(m.name, '') as manufacturer"),
                DB::raw('ROUND(p.price, 6) as original_price_tax_excl'),
                DB::raw('ROUND(p.price, 6) as original_price_tax_incl'),
            ])
            ->selectSub($nameSubquery, 'name')
            ->selectSub($stockSubquery, 'stock_qty')
            ->selectSub(clone $currentPriceSubquery, 'current_price_tax_excl')
            ->selectSub($currentPriceSubquery, 'current_price_tax_incl');

        $searchQuery = self::resolveSearchQuery();

        if ($searchQuery === null) {
            return $query->orderByDesc('p.id_product');
        }

        $productIds = self::resolveTypeSenseProductIds($searchQuery);

        if ($productIds === []) {
            return $query->whereRaw('1 = 0');
        }

        return $query
            ->whereIn('p.id_product', $productIds)
            ->orderByRaw('FIELD(p.id_product, '.implode(',', $productIds).')');
    }

    private static function resolveSearchQuery(): ?string
    {
        $query = request()->query('q');

        if (! is_string($query) || trim($query) === '') {
            $query = request()->query('tableSearch');
        }

        if (! is_string($query) || trim($query) === '') {
            return null;
        }

        return trim($query);
    }

    /**
     * @return list<int>
     */
    private static function resolveTypeSenseProductIds(string $query): array
    {
        $tenantId = app(TenantContext::class)->tenantId() ?? (int) request()->attributes->get('tenant_id');

        if ($tenantId < 1) {
            return [];
        }

        try {
            $results = app(TypeSenseClient::class)->searchProductDocs(
                tenantId: $tenantId,
                query: $query,
                page: 1,
                perPage: 250,
            );
        } catch (Throwable) {
            return [];
        }

        /** @var list<int> $productIds */
        $productIds = collect($results['data'])
            ->map(fn (mixed $product): int => (int) data_get($product, 'id', 0))
            ->filter(fn (int $id): bool => $id > 0)
            ->unique()
            ->values()
            ->all();

        return $productIds;
    }
}
