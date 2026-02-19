<?php

namespace App\Filament\App\Resources\Products\Pages;

use App\Filament\App\Resources\Products\ProductResource;
use App\Services\ProductWriteService;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use RuntimeException;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('updateStock')
                ->label(__('saas.resources.products.view.actions.update_stock'))
                ->form([
                    TextInput::make('qty')
                        ->label(__('saas.resources.products.view.fields.stock_qty'))
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->step(1),
                ])
                ->action(function (array $data, ProductWriteService $productWriteService): void {
                    $productId = (int) data_get($this->getRecord(), 'id_product', 0);

                    try {
                        $productWriteService->updateProductStock(
                            productId: $productId,
                            qty: (int) $data['qty'],
                        );

                        $this->reloadRecord();

                        Notification::make()
                            ->success()
                            ->title(__('saas.resources.products.view.notifications.stock_update_success'))
                            ->send();
                    } catch (RuntimeException $exception) {
                        Notification::make()
                            ->danger()
                            ->title(__('saas.resources.products.view.notifications.stock_update_failed'))
                            ->body($exception->getMessage())
                            ->send();
                    }
                }),
            Action::make('updateBasePrice')
                ->label(__('saas.resources.products.view.actions.update_base_price'))
                ->form([
                    TextInput::make('price_excl')
                        ->label(__('saas.resources.products.view.fields.base_price_tax_excl'))
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->step(0.000001),
                ])
                ->action(function (array $data, ProductWriteService $productWriteService): void {
                    $productId = (int) data_get($this->getRecord(), 'id_product', 0);

                    try {
                        $productWriteService->updateProductBasePrice(
                            productId: $productId,
                            priceExcl: (float) $data['price_excl'],
                        );

                        $this->reloadRecord();

                        Notification::make()
                            ->success()
                            ->title(__('saas.resources.products.view.notifications.base_price_update_success'))
                            ->send();
                    } catch (RuntimeException $exception) {
                        Notification::make()
                            ->danger()
                            ->title(__('saas.resources.products.view.notifications.base_price_update_failed'))
                            ->body($exception->getMessage())
                            ->send();
                    }
                }),
        ];
    }

    private function reloadRecord(): void
    {
        $productId = (int) data_get($this->getRecord(), 'id_product', 0);

        $freshRecord = ProductResource::getEloquentQuery()
            ->where('id_product', $productId)
            ->first();

        if ($freshRecord !== null) {
            $this->record = $freshRecord;
        }
    }
}
