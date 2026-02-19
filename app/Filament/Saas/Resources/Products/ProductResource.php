<?php

namespace App\Filament\Saas\Resources\Products;

use App\Filament\Saas\Resources\Products\Pages\ListProducts;
use App\Filament\Saas\Resources\Products\Pages\ViewProduct;
use App\Filament\Saas\Resources\Products\RelationManagers\SpecificPricesRelationManager;
use App\Models\TenantPrestaShopProduct;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopConnection;
use App\Services\TypeSenseClient;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Throwable;

class ProductResource extends Resource
{
    protected static ?string $model = TenantPrestaShopProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 30;

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

    public static function canView($record): bool
    {
        return Gate::allows('view-tenant-products');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchPlaceholder(__('saas.resources.products.table.search_placeholder'))
            ->columns([
                TextColumn::make('id_product')
                    ->label(__('saas.resources.products.table.columns.id'))
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('saas.resources.products.table.columns.name'))
                    ->searchable(query: fn (Builder $query, string $search): Builder => $query)
                    ->wrap(),
                TextColumn::make('reference')
                    ->label(__('saas.resources.products.table.columns.reference'))
                    ->toggleable(),
                TextColumn::make('manufacturer')
                    ->label(__('saas.resources.products.table.columns.manufacturer'))
                    ->toggleable(),
                IconColumn::make('active')
                    ->label(__('saas.resources.products.table.columns.active'))
                    ->boolean(),
                TextColumn::make('stock_qty')
                    ->label(__('saas.resources.products.table.columns.stock_qty'))
                    ->numeric(0)
                    ->alignRight()
                    ->sortable(),
                TextColumn::make('original_price_tax_excl')
                    ->label(__('saas.resources.products.table.columns.original_price_tax_excl'))
                    ->numeric(2)
                    ->alignRight()
                    ->sortable(),
                TextColumn::make('current_price_tax_excl')
                    ->label(__('saas.resources.products.table.columns.current_price_tax_excl'))
                    ->numeric(2)
                    ->alignRight()
                    ->sortable(),
                TextColumn::make('original_price_tax_incl')
                    ->label(__('saas.resources.products.table.columns.original_price_tax_incl'))
                    ->numeric(2)
                    ->alignRight()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('current_price_tax_incl')
                    ->label(__('saas.resources.products.table.columns.current_price_tax_incl'))
                    ->numeric(2)
                    ->alignRight()
                    ->sortable()
                    ->toggleable(),
            ])
            ->actions([
                ViewAction::make()
                    ->label(__('saas.resources.products.table.actions.view')),
            ])
            ->recordAction('view')
            ->emptyStateHeading(__('saas.resources.products.table.empty_state_heading'));
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make(__('saas.resources.products.infolist.sections.general'))
                    ->columns(2)
                    ->schema([
                        TextEntry::make('id_product')
                            ->label(__('saas.resources.products.table.columns.id')),
                        TextEntry::make('name')
                            ->label(__('saas.resources.products.table.columns.name')),
                        TextEntry::make('reference')
                            ->label(__('saas.resources.products.table.columns.reference')),
                        TextEntry::make('manufacturer')
                            ->label(__('saas.resources.products.table.columns.manufacturer')),
                        TextEntry::make('active')
                            ->label(__('saas.resources.products.table.columns.active'))
                            ->badge()
                            ->formatStateUsing(function (mixed $state): string {
                                return (bool) $state
                                    ? __('saas.resources.products.states.active')
                                    : __('saas.resources.products.states.inactive');
                            })
                            ->color(fn (mixed $state): string => (bool) $state ? 'success' : 'danger'),
                        TextEntry::make('stock_qty')
                            ->label(__('saas.resources.products.table.columns.stock_qty'))
                            ->numeric(0),
                    ]),
                Section::make(__('saas.resources.products.infolist.sections.pricing'))
                    ->columns(2)
                    ->schema([
                        TextEntry::make('original_price_tax_excl')
                            ->label(__('saas.resources.products.table.columns.original_price_tax_excl'))
                            ->numeric(2),
                        TextEntry::make('current_price_tax_excl')
                            ->label(__('saas.resources.products.table.columns.current_price_tax_excl'))
                            ->numeric(2),
                        TextEntry::make('original_price_tax_incl')
                            ->label(__('saas.resources.products.table.columns.original_price_tax_incl'))
                            ->numeric(2),
                        TextEntry::make('current_price_tax_incl')
                            ->label(__('saas.resources.products.table.columns.current_price_tax_incl'))
                            ->numeric(2),
                    ]),
            ]);
    }

    /**
     * @return array<string, class-string>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'view' => ViewProduct::route('/{record}'),
        ];
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

        $searchQuery = static::resolveSearchQuery();

        if ($searchQuery === null) {
            return $query->orderByDesc('p.id_product');
        }

        $productIds = static::resolveTypeSenseProductIds($searchQuery);

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
        $productIds = collect($results['data'] ?? [])
            ->map(fn (mixed $product): int => (int) data_get($product, 'id', 0))
            ->filter(fn (int $id): bool => $id > 0)
            ->unique()
            ->values()
            ->all();

        return $productIds;
    }
}
