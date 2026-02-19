<?php

namespace App\Filament\App\Resources\Products\Tables;

use App\Filament\App\Resources\Products\ProductResource;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchable()
            ->searchUsing(function (Builder $query, string $search): void {
                ProductResource::applyTypeSenseSearch($query, $search);
            })
            ->persistSearchInSession()
            ->searchPlaceholder(__('saas.resources.products.table.search_placeholder'))
            ->defaultSort('id_product', 'desc')
            ->defaultPaginationPageOption(50)
            ->paginationPageOptions([25, 50, 100])
            ->columns([
                TextColumn::make('id_product')
                    ->label(__('saas.resources.products.table.columns.id'))
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('saas.resources.products.table.columns.name'))
                    ->searchable(false)
                    ->wrap(),
                TextColumn::make('reference')
                    ->label(__('saas.resources.products.table.columns.reference'))
                    ->searchable(false)
                    ->toggleable(),
                TextColumn::make('manufacturer')
                    ->label(__('saas.resources.products.table.columns.manufacturer'))
                    ->searchable(false)
                    ->toggleable(),
                IconColumn::make('active')
                    ->label(__('saas.resources.products.table.columns.active'))
                    ->boolean()
                    ->color(fn (mixed $state): string => (bool) $state ? 'success' : 'danger')
                    ->tooltip(fn (mixed $state): string => (bool) $state
                        ? __('saas.resources.products.states.active')
                        : __('saas.resources.products.states.inactive')),
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
            ->filters([
                TernaryFilter::make('active')
                    ->label(__('saas.resources.products.table.filters.active'))
                    ->queries(
                        true: fn (Builder $query): Builder => $query->where('p.active', true),
                        false: fn (Builder $query): Builder => $query->where('p.active', false),
                    ),
                Filter::make('in_stock')
                    ->label(__('saas.resources.products.table.filters.in_stock'))
                    ->query(fn (Builder $query): Builder => $query->where('stock.stock_qty', '>', 0)),
                SelectFilter::make('manufacturer')
                    ->label(__('saas.resources.products.table.filters.manufacturer'))
                    ->options(fn (): array => ProductResource::manufacturerFilterOptions())
                    ->searchable()
                    ->query(function (Builder $query, array $data): Builder {
                        $manufacturerId = (int) ($data['value'] ?? 0);

                        if ($manufacturerId < 1) {
                            return $query;
                        }

                        return $query->where('p.id_manufacturer', $manufacturerId);
                    }),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label(__('saas.resources.products.table.actions.view')),
            ])
            ->recordAction('view')
            ->emptyStateHeading(__('saas.resources.products.table.empty_state_heading'));
    }
}
