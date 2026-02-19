<?php

namespace App\Filament\App\Resources\Products\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
    public static function configure(Table $table): Table
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
            ->recordActions([
                ViewAction::make()
                    ->label(__('saas.resources.products.table.actions.view')),
            ])
            ->recordAction('view')
            ->emptyStateHeading(__('saas.resources.products.table.empty_state_heading'));
    }
}
