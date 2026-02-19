<?php

namespace App\Filament\App\Resources\Products\RelationManagers;

use App\Models\TenantPrestaShopSpecificPrice;
use App\Services\ProductWriteService;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use RuntimeException;

class SpecificPricesRelationManager extends RelationManager
{
    protected static string $relationship = 'specificPrices';

    public static function getTitle(mixed $ownerRecord, string $pageClass): string
    {
        return __('saas.resources.products.relation_managers.specific_prices.title');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components($this->getFormSchema());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id_specific_price')
            ->columns([
                TextColumn::make('id_specific_price')
                    ->label(__('saas.resources.products.relation_managers.specific_prices.columns.id'))
                    ->sortable(),
                TextColumn::make('price')
                    ->label(__('saas.resources.products.relation_managers.specific_prices.columns.price'))
                    ->numeric(6)
                    ->alignRight(),
                TextColumn::make('reduction')
                    ->label(__('saas.resources.products.relation_managers.specific_prices.columns.reduction'))
                    ->numeric(6)
                    ->alignRight(),
                TextColumn::make('reduction_type')
                    ->label(__('saas.resources.products.relation_managers.specific_prices.columns.reduction_type')),
                TextColumn::make('from')
                    ->label(__('saas.resources.products.relation_managers.specific_prices.columns.from'))
                    ->dateTime(),
                TextColumn::make('to')
                    ->label(__('saas.resources.products.relation_managers.specific_prices.columns.to'))
                    ->dateTime(),
            ])
            ->headerActions([
                Action::make('createSpecificPrice')
                    ->label(__('saas.resources.products.relation_managers.specific_prices.actions.create'))
                    ->icon('heroicon-o-plus')
                    ->form($this->getFormSchema())
                    ->action(function (array $data, ProductWriteService $productWriteService): void {
                        $productId = (int) data_get($this->getOwnerRecord(), 'id_product', 0);

                        try {
                            $productWriteService->createProductSpecificPrice(
                                productId: $productId,
                                payload: $data,
                            );

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.products.relation_managers.specific_prices.notifications.create_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.products.relation_managers.specific_prices.notifications.create_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
            ])
            ->actions([
                Action::make('editSpecificPrice')
                    ->label(__('saas.resources.products.relation_managers.specific_prices.actions.edit'))
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(function (TenantPrestaShopSpecificPrice $record): array {
                        return [
                            'price' => (float) data_get($record, 'price', 0),
                            'reduction' => (float) data_get($record, 'reduction', 0),
                            'reduction_type' => (string) data_get($record, 'reduction_type', ''),
                            'from' => (string) data_get($record, 'from', ''),
                            'to' => (string) data_get($record, 'to', ''),
                        ];
                    })
                    ->form($this->getFormSchema())
                    ->action(function (array $data, TenantPrestaShopSpecificPrice $record, ProductWriteService $productWriteService): void {
                        $productId = (int) data_get($this->getOwnerRecord(), 'id_product', 0);
                        $specificPriceId = (int) data_get($record, 'id_specific_price', 0);

                        try {
                            $productWriteService->updateProductSpecificPrice(
                                productId: $productId,
                                specificPriceId: $specificPriceId,
                                payload: $data,
                            );

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.products.relation_managers.specific_prices.notifications.update_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.products.relation_managers.specific_prices.notifications.update_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
                Action::make('deleteSpecificPrice')
                    ->label(__('saas.resources.products.relation_managers.specific_prices.actions.delete'))
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (TenantPrestaShopSpecificPrice $record, ProductWriteService $productWriteService): void {
                        $productId = (int) data_get($this->getOwnerRecord(), 'id_product', 0);
                        $specificPriceId = (int) data_get($record, 'id_specific_price', 0);

                        try {
                            $productWriteService->deleteProductSpecificPrice(
                                productId: $productId,
                                specificPriceId: $specificPriceId,
                            );

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.products.relation_managers.specific_prices.notifications.delete_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.products.relation_managers.specific_prices.notifications.delete_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
            ]);
    }

    /**
     * @return array<int, DateTimePicker|Select|TextInput>
     */
    private function getFormSchema(): array
    {
        return [
            TextInput::make('price')
                ->label(__('saas.resources.products.relation_managers.specific_prices.fields.price'))
                ->numeric()
                ->required()
                ->step(0.000001)
                ->minValue(-1),
            TextInput::make('reduction')
                ->label(__('saas.resources.products.relation_managers.specific_prices.fields.reduction'))
                ->numeric()
                ->required()
                ->step(0.000001)
                ->minValue(0),
            Select::make('reduction_type')
                ->label(__('saas.resources.products.relation_managers.specific_prices.fields.reduction_type'))
                ->options([
                    'amount' => __('saas.resources.products.relation_managers.specific_prices.reduction_types.amount'),
                    'percentage' => __('saas.resources.products.relation_managers.specific_prices.reduction_types.percentage'),
                ])
                ->required(),
            DateTimePicker::make('from')
                ->label(__('saas.resources.products.relation_managers.specific_prices.fields.from'))
                ->required()
                ->seconds(false),
            DateTimePicker::make('to')
                ->label(__('saas.resources.products.relation_managers.specific_prices.fields.to'))
                ->required()
                ->seconds(false),
        ];
    }
}
