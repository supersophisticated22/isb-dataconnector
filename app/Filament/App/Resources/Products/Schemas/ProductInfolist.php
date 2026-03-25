<?php

namespace App\Filament\App\Resources\Products\Schemas;

use App\DTO\ProductViewData;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

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
                            ->formatStateUsing(function (TextEntry $component): string {
                                return self::viewData($component->getRecord())->isActive
                                    ? __('saas.resources.products.states.active')
                                    : __('saas.resources.products.states.inactive');
                            })
                            ->color(fn (TextEntry $component): string => self::viewData($component->getRecord())->isActive ? 'success' : 'danger'),
                        TextEntry::make('stock_qty')
                            ->label(__('saas.resources.products.table.columns.stock_qty'))
                            ->numeric(0)
                            ->badge()
                            ->formatStateUsing(function (TextEntry $component, mixed $state): string {
                                $stockQty = (int) $state;
                                $stockStatus = self::viewData($component->getRecord())->stockStatus;

                                return $stockStatus === 'in_stock'
                                    ? $stockQty.' '.__('saas.resources.products.infolist.stock.in_stock')
                                    : $stockQty.' '.__('saas.resources.products.infolist.stock.out_of_stock');
                            })
                            ->color(fn (TextEntry $component): string => self::viewData($component->getRecord())->stockStatus === 'in_stock' ? 'success' : 'danger'),
                    ]),
                Section::make(__('saas.resources.products.infolist.sections.pricing'))
                    ->columns(2)
                    ->schema([
                        TextEntry::make('original_price_tax_excl')
                            ->label(__('saas.resources.products.table.columns.original_price_tax_excl'))
                            ->formatStateUsing(fn (mixed $state): string => Number::currency((float) $state, 'EUR')),
                        TextEntry::make('current_price_tax_excl')
                            ->label(__('saas.resources.products.table.columns.current_price_tax_excl'))
                            ->formatStateUsing(fn (mixed $state): string => Number::currency((float) $state, 'EUR'))
                            ->badge()
                            ->color(fn (TextEntry $component): string => self::viewData($component->getRecord())->discounted ? 'success' : 'gray'),
                        TextEntry::make('original_price_tax_incl')
                            ->label(__('saas.resources.products.table.columns.original_price_tax_incl'))
                            ->formatStateUsing(fn (mixed $state): string => Number::currency((float) $state, 'EUR')),
                        TextEntry::make('current_price_tax_incl')
                            ->label(__('saas.resources.products.table.columns.current_price_tax_incl'))
                            ->formatStateUsing(fn (mixed $state): string => Number::currency((float) $state, 'EUR'))
                            ->badge()
                            ->color(fn (TextEntry $component): string => self::viewData($component->getRecord())->discounted ? 'success' : 'gray'),
                        TextEntry::make('current_price_tax_excl_formatted')
                            ->label(__('saas.resources.products.infolist.labels.formatted_price'))
                            ->state(fn (TextEntry $component): string => self::viewData($component->getRecord())->formattedPrice),
                    ]),
                Section::make(__('saas.resources.products.view.actions.edit_content'))
                    ->columns(1)
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('description')
                            ->label(__('saas.resources.products.view.fields.description'))
                            ->columnSpanFull(),
                        TextEntry::make('meta_title')
                            ->label(__('saas.resources.products.view.fields.meta_title')),
                        TextEntry::make('meta_description')
                            ->label(__('saas.resources.products.view.fields.meta_description')),
                        TextEntry::make('meta_keywords')
                            ->label(__('saas.resources.products.view.fields.meta_keywords'))
                            ->columnSpanFull(),
                    ]),
                Section::make(__('saas.resources.products.infolist.sections.specific_price'))
                    ->visible(fn (Section $component): bool => self::viewData($component->getRecord())->discounted)
                    ->schema([
                        TextEntry::make('specific_price_badge')
                            ->label(__('saas.resources.products.infolist.labels.specific_price'))
                            ->badge()
                            ->state(__('saas.resources.products.infolist.labels.discounted'))
                            ->color('success'),
                    ]),
            ]);
    }

    /**
     * @param  Model|array<string, mixed>|mixed  $record
     */
    private static function viewData(mixed $record): ProductViewData
    {
        if (is_array($record) || $record instanceof Model) {
            return ProductViewData::fromRecord($record);
        }

        return ProductViewData::fromRecord([]);
    }
}
