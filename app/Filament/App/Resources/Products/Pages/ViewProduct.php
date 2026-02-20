<?php

namespace App\Filament\App\Resources\Products\Pages;

use App\Filament\App\Resources\Products\ProductResource;
use App\Services\ProductWriteService;
use App\Services\TenantPrestaShopConnection;
use App\Services\TenantPrestaShopProductContentService;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use Throwable;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        $languageOptions = $this->resolveLanguageOptions();

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
            Action::make('editContent')
                ->label(__('saas.resources.products.view.actions.edit_content'))
                ->disabled($languageOptions === [])
                ->fillForm(fn (): array => $this->resolveContentFormState($languageOptions))
                ->form([
                    Select::make('id_lang')
                        ->label(__('saas.resources.products.view.fields.language'))
                        ->options($languageOptions)
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Set $set, mixed $state): void {
                            $langId = (int) $state;

                            if ($langId < 1) {
                                $this->setContentFields($set, $this->emptyContent());

                                return;
                            }

                            try {
                                $this->setContentFields(
                                    $set,
                                    app(TenantPrestaShopProductContentService::class)->getContent(
                                        productId: $this->resolveProductId(),
                                        langId: $langId,
                                    )
                                );
                            } catch (RuntimeException) {
                                $this->setContentFields($set, $this->emptyContent());
                            }
                        }),
                    TextInput::make('content_name')
                        ->label(__('saas.resources.products.view.fields.name'))
                        ->required()
                        ->maxLength(255),
                    RichEditor::make('content_description_short')
                        ->label(__('saas.resources.products.view.fields.description_short')),
                    RichEditor::make('content_description')
                        ->label(__('saas.resources.products.view.fields.description')),
                    TextInput::make('content_meta_title')
                        ->label(__('saas.resources.products.view.fields.meta_title'))
                        ->maxLength(255),
                    Textarea::make('content_meta_description')
                        ->label(__('saas.resources.products.view.fields.meta_description'))
                        ->rows(3)
                        ->maxLength(512),
                    Textarea::make('content_meta_keywords')
                        ->label(__('saas.resources.products.view.fields.meta_keywords'))
                        ->rows(2),
                    TextInput::make('content_link_rewrite')
                        ->label(__('saas.resources.products.view.fields.link_rewrite'))
                        ->required()
                        ->maxLength(128)
                        ->rule('regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'),
                ])
                ->action(function (array $data, TenantPrestaShopProductContentService $contentService): void {
                    $productId = $this->resolveProductId();
                    $langId = (int) ($data['id_lang'] ?? 0);

                    try {
                        $contentService->upsertContent(
                            productId: $productId,
                            langId: $langId,
                            payload: [
                                'name' => $data['content_name'] ?? null,
                                'description_short' => $data['content_description_short'] ?? null,
                                'description' => $data['content_description'] ?? null,
                                'meta_title' => $data['content_meta_title'] ?? null,
                                'meta_description' => $data['content_meta_description'] ?? null,
                                'meta_keywords' => $data['content_meta_keywords'] ?? null,
                                'link_rewrite' => $data['content_link_rewrite'] ?? null,
                            ],
                        );

                        $this->reloadRecord();

                        Notification::make()
                            ->success()
                            ->title(__('saas.resources.products.view.notifications.content_update_success'))
                            ->send();
                    } catch (RuntimeException $exception) {
                        Notification::make()
                            ->danger()
                            ->title(__('saas.resources.products.view.notifications.content_update_failed'))
                            ->body($exception->getMessage())
                            ->send();
                    }
                }),
        ];
    }

    /**
     * @return array<int, string>
     */
    private function resolveLanguageOptions(): array
    {
        try {
            $languageTable = app(TenantPrestaShopConnection::class)->table('lang');
            $languages = DB::connection('tenant_ps')
                ->table($languageTable)
                ->orderBy('id_lang')
                ->get(['id_lang', 'name', 'iso_code']);

            if ($languages->isEmpty()) {
                return [];
            }

            /** @var array<int, string> $options */
            $options = $languages
                ->mapWithKeys(function (object $language): array {
                    $idLang = (int) data_get($language, 'id_lang', 0);
                    $name = trim((string) data_get($language, 'name', ''));
                    $isoCode = strtoupper(trim((string) data_get($language, 'iso_code', '')));

                    if ($idLang < 1 || $name === '') {
                        return [];
                    }

                    $label = $isoCode !== '' ? $name.' ('.$isoCode.')' : $name;

                    return [$idLang => $label];
                })
                ->all();
        } catch (Throwable) {
            return [];
        }

        return $options;
    }

    /**
     * @param  array<int, string>  $languageOptions
     * @return array<string, mixed>
     */
    private function resolveContentFormState(array $languageOptions): array
    {
        $defaultLanguageId = (int) array_key_first($languageOptions);

        if ($defaultLanguageId < 1) {
            return [
                'id_lang' => null,
                ...$this->emptyContent(),
            ];
        }

        try {
            $content = app(TenantPrestaShopProductContentService::class)->getContent(
                productId: $this->resolveProductId(),
                langId: $defaultLanguageId,
            );
        } catch (RuntimeException) {
            $content = $this->emptyContent();
        }

        return [
            'id_lang' => $defaultLanguageId,
            ...$this->mapContentToFormState($content),
        ];
    }

    /**
     * @param  array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string}  $content
     */
    private function setContentFields(Set $set, array $content): void
    {
        $set('content_name', $content['name']);
        $set('content_description_short', $content['description_short']);
        $set('content_description', $content['description']);
        $set('content_meta_title', $content['meta_title']);
        $set('content_meta_description', $content['meta_description']);
        $set('content_meta_keywords', $content['meta_keywords']);
        $set('content_link_rewrite', $content['link_rewrite']);
    }

    /**
     * @return array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string}
     */
    private function emptyContent(): array
    {
        return [
            'name' => '',
            'description_short' => null,
            'description' => null,
            'meta_title' => null,
            'meta_description' => null,
            'meta_keywords' => null,
            'link_rewrite' => '',
        ];
    }

    /**
     * @param  array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string}  $content
     * @return array{
     *     content_name:string,
     *     content_description_short:?string,
     *     content_description:?string,
     *     content_meta_title:?string,
     *     content_meta_description:?string,
     *     content_meta_keywords:?string,
     *     content_link_rewrite:string
     * }
     */
    private function mapContentToFormState(array $content): array
    {
        return [
            'content_name' => $content['name'],
            'content_description_short' => $content['description_short'],
            'content_description' => $content['description'],
            'content_meta_title' => $content['meta_title'],
            'content_meta_description' => $content['meta_description'],
            'content_meta_keywords' => $content['meta_keywords'],
            'content_link_rewrite' => $content['link_rewrite'],
        ];
    }

    private function resolveProductId(): int
    {
        $routeRecord = request()->route('record');

        if (is_numeric($routeRecord)) {
            return (int) $routeRecord;
        }

        return (int) data_get($this->getRecord(), 'id_product', 0);
    }

    private function reloadRecord(): void
    {
        $productId = $this->resolveProductId();

        $freshRecord = ProductResource::getEloquentQuery()
            ->where('p.id_product', $productId)
            ->first();

        if ($freshRecord !== null) {
            $this->record = $freshRecord;
            $this->cacheSchema('infolist', null);
        }
    }
}
