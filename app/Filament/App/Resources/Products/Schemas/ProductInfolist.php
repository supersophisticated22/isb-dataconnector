<?php

namespace App\Filament\App\Resources\Products\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
}
