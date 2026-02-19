<?php

namespace App\Filament\App\Resources\Products\Pages;

use App\Filament\App\Pages\BulkPriceUpdate;
use App\Filament\App\Resources\Products\ProductResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('bulkPriceUpdate')
                ->label(__('saas.pages.bulk_price_update.navigation_label'))
                ->url(BulkPriceUpdate::getUrl()),
        ];
    }
}
