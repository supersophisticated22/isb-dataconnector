<?php

namespace App\Filament\App\Widgets;

use App\Filament\App\Resources\Products\ProductResource;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductOverviewStats extends StatsOverviewWidget
{
    protected int|string|array $columnSpan = 'full';

    protected ?string $heading = 'Product overview';

    /**
     * @return array<Stat>
     */
    protected function getStats(): array
    {
        return [
            Stat::make('Total', $this->getTotalProducts())
                ->color('primary'),
            Stat::make('Active', $this->getActiveProducts())
                ->color('success'),
            Stat::make('Out of stock', $this->getOutOfStockProducts())
                ->color('danger'),
        ];
    }

    private function getTotalProducts(): int
    {
        return ProductResource::getEloquentQuery()->count();
    }

    private function getActiveProducts(): int
    {
        return ProductResource::getEloquentQuery()
            ->where('p.active', true)
            ->count();
    }

    private function getOutOfStockProducts(): int
    {
        return ProductResource::getEloquentQuery()
            ->whereRaw('COALESCE(stock.stock_qty, 0) <= 0')
            ->count();
    }
}
