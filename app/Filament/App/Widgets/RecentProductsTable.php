<?php

namespace App\Filament\App\Widgets;

use App\Filament\App\Resources\Products\ProductResource;
use App\Models\TenantPrestaShopProduct;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentProductsTable extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(ProductResource::getEloquentQuery())
            ->defaultSort('id_product', 'desc')
            ->paginated([10])
            ->columns([
                TextColumn::make('id_product')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Name')
                    ->wrap(),
                IconColumn::make('active')
                    ->label('Active')
                    ->boolean(),
                TextColumn::make('stock_qty')
                    ->label('Stock')
                    ->numeric(0)
                    ->alignRight(),
                TextColumn::make('current_price_tax_incl')
                    ->label('Price')
                    ->numeric(2)
                    ->alignRight(),
            ])
            ->recordActions([
                ViewAction::make()
                    ->url(function (TenantPrestaShopProduct $record): ?string {
                        $tenant = Filament::getTenant();

                        if ($tenant === null) {
                            return null;
                        }

                        return route('filament.app.resources.products.view', [
                            'tenant' => $tenant,
                            'record' => $record,
                        ]);
                    }),
            ]);
    }
}
