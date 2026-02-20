<?php

namespace App\Filament\App\Resources\Products\Pages;

use App\Filament\App\Resources\Products\ProductResource;
use App\Services\ProductWriteService;
use App\Services\TenantPrestaShopCategoryService;
use App\Services\TenantPrestaShopConnection;
use App\Services\TenantPrestaShopProductEditorService;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Utilities\Get;
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
            Action::make('editProduct')
                ->label(__('saas.resources.products.view.actions.edit_product'))
                ->disabled($languageOptions === [])
                ->fillForm(fn (): array => $this->resolveProductEditFormState($languageOptions))
                ->form([
                    Select::make('id_lang')
                        ->label(__('saas.resources.products.view.fields.language'))
                        ->options($languageOptions)
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Set $set, mixed $state): void {
                            $langId = (int) $state;

                            if ($langId < 1) {
                                $this->setProductEditFields($set, $this->emptyProductEditData());

                                return;
                            }

                            try {
                                $this->setProductEditFields(
                                    $set,
                                    app(TenantPrestaShopProductEditorService::class)->getProductEditData(
                                        productId: $this->resolveProductId(),
                                        langId: $langId,
                                    )
                                );
                            } catch (RuntimeException) {
                                $this->setProductEditFields($set, $this->emptyProductEditData());
                            }
                        }),
                    TextInput::make('name')
                        ->label(__('saas.resources.products.view.fields.name'))
                        ->required()
                        ->maxLength(255),
                    RichEditor::make('description_short')
                        ->label(__('saas.resources.products.view.fields.description_short')),
                    RichEditor::make('description')
                        ->label(__('saas.resources.products.view.fields.description')),
                    TextInput::make('meta_title')
                        ->label(__('saas.resources.products.view.fields.meta_title'))
                        ->maxLength(255),
                    Textarea::make('meta_description')
                        ->label(__('saas.resources.products.view.fields.meta_description'))
                        ->rows(3)
                        ->maxLength(512),
                    Textarea::make('meta_keywords')
                        ->label(__('saas.resources.products.view.fields.meta_keywords'))
                        ->rows(2),
                    TextInput::make('link_rewrite')
                        ->label(__('saas.resources.products.view.fields.link_rewrite'))
                        ->required()
                        ->maxLength(128)
                        ->rule('regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'),
                    TextInput::make('weight')
                        ->label(__('saas.resources.products.view.fields.weight'))
                        ->numeric()
                        ->minValue(0)
                        ->step(0.000001),
                    Select::make('defaultCategoryId')
                        ->label(__('saas.resources.products.view.fields.default_category'))
                        ->options(fn (Get $get): array => $this->resolveCategoryOptions((int) $get('id_lang')))
                        ->required()
                        ->searchable()
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set, mixed $state): void {
                            $defaultCategoryId = (int) $state;
                            $selectedCategoryIds = collect($get('categoryIds') ?? [])
                                ->map(static fn (mixed $id): int => (int) $id)
                                ->filter(static fn (int $id): bool => $id > 0)
                                ->unique()
                                ->values()
                                ->all();

                            if ($defaultCategoryId > 0 && ! in_array($defaultCategoryId, $selectedCategoryIds, true)) {
                                array_unshift($selectedCategoryIds, $defaultCategoryId);
                                $set('categoryIds', $selectedCategoryIds);
                            }
                        }),
                    Select::make('categoryIds')
                        ->label(__('saas.resources.products.view.fields.categories'))
                        ->options(fn (Get $get): array => $this->resolveCategoryOptions((int) $get('id_lang')))
                        ->multiple()
                        ->required()
                        ->searchable(),
                    TextInput::make('inhoud')
                        ->label(__('saas.resources.products.view.fields.inhoud'))
                        ->maxLength(255),
                ])
                ->action(function (array $data, TenantPrestaShopProductEditorService $productEditorService): void {
                    $productId = $this->resolveProductId();
                    $langId = (int) ($data['id_lang'] ?? 0);

                    try {
                        $productEditorService->updateProduct(
                            productId: $productId,
                            langId: $langId,
                            payload: [
                                'name' => $data['name'] ?? null,
                                'description_short' => $data['description_short'] ?? null,
                                'description' => $data['description'] ?? null,
                                'meta_title' => $data['meta_title'] ?? null,
                                'meta_description' => $data['meta_description'] ?? null,
                                'meta_keywords' => $data['meta_keywords'] ?? null,
                                'link_rewrite' => $data['link_rewrite'] ?? null,
                                'weight' => $data['weight'] ?? null,
                                'defaultCategoryId' => $data['defaultCategoryId'] ?? null,
                                'categoryIds' => $data['categoryIds'] ?? [],
                                'inhoud' => $data['inhoud'] ?? null,
                            ],
                        );

                        $this->reloadRecord();

                        Notification::make()
                            ->success()
                            ->title(__('saas.resources.products.view.notifications.product_update_success'))
                            ->send();
                    } catch (RuntimeException $exception) {
                        Notification::make()
                            ->danger()
                            ->title(__('saas.resources.products.view.notifications.product_update_failed'))
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
    private function resolveProductEditFormState(array $languageOptions): array
    {
        $defaultLanguageId = (int) array_key_first($languageOptions);

        if ($defaultLanguageId < 1) {
            return [
                'id_lang' => null,
                ...$this->emptyProductEditData(),
            ];
        }

        try {
            $productData = app(TenantPrestaShopProductEditorService::class)->getProductEditData(
                productId: $this->resolveProductId(),
                langId: $defaultLanguageId,
            );
        } catch (RuntimeException) {
            $productData = $this->emptyProductEditData();
        }

        return [
            'id_lang' => $defaultLanguageId,
            ...$this->mapProductDataToFormState($productData),
        ];
    }

    /**
     * @param  array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string,weight:?float,defaultCategoryId:?int,categoryIds:list<int>,inhoud:?string,inhoudFeatureId:?int}  $content
     */
    private function setProductEditFields(Set $set, array $content): void
    {
        $set('name', $content['name']);
        $set('description_short', $content['description_short']);
        $set('description', $content['description']);
        $set('meta_title', $content['meta_title']);
        $set('meta_description', $content['meta_description']);
        $set('meta_keywords', $content['meta_keywords']);
        $set('link_rewrite', $content['link_rewrite']);
        $set('weight', $content['weight']);
        $set('defaultCategoryId', $content['defaultCategoryId']);
        $set('categoryIds', $content['categoryIds']);
        $set('inhoud', $content['inhoud']);
    }

    /**
     * @return array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string,weight:?float,defaultCategoryId:?int,categoryIds:list<int>,inhoud:?string,inhoudFeatureId:?int}
     */
    private function emptyProductEditData(): array
    {
        return [
            'name' => '',
            'description_short' => null,
            'description' => null,
            'meta_title' => null,
            'meta_description' => null,
            'meta_keywords' => null,
            'link_rewrite' => '',
            'weight' => null,
            'defaultCategoryId' => null,
            'categoryIds' => [],
            'inhoud' => null,
            'inhoudFeatureId' => null,
        ];
    }

    /**
     * @param  array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string,weight:?float,defaultCategoryId:?int,categoryIds:list<int>,inhoud:?string,inhoudFeatureId:?int}  $content
     * @return array{
     *     name:string,
     *     description_short:?string,
     *     description:?string,
     *     meta_title:?string,
     *     meta_description:?string,
     *     meta_keywords:?string,
     *     link_rewrite:string,
     *     weight:?float,
     *     defaultCategoryId:?int,
     *     categoryIds:list<int>,
     *     inhoud:?string
     * }
     */
    private function mapProductDataToFormState(array $content): array
    {
        return [
            'name' => $content['name'],
            'description_short' => $content['description_short'],
            'description' => $content['description'],
            'meta_title' => $content['meta_title'],
            'meta_description' => $content['meta_description'],
            'meta_keywords' => $content['meta_keywords'],
            'link_rewrite' => $content['link_rewrite'],
            'weight' => $content['weight'],
            'defaultCategoryId' => $content['defaultCategoryId'],
            'categoryIds' => $content['categoryIds'],
            'inhoud' => $content['inhoud'],
        ];
    }

    /**
     * @return array<int, string>
     */
    private function resolveCategoryOptions(int $langId): array
    {
        if ($langId < 1) {
            return [];
        }

        try {
            return app(TenantPrestaShopCategoryService::class)->getCategoryOptions($langId);
        } catch (RuntimeException) {
            return [];
        }
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
