<?php

namespace App\Filament\App\Resources\CmsCategories;

use App\Filament\App\Resources\CmsCategories\Pages\ManageCmsCategories;
use App\Models\TenantPrestaShopProduct;
use App\Models\User;
use App\Services\CmsPerformanceProbe;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopCmsCategoryService;
use App\Services\TenantPrestaShopCmsPageService;
use App\Services\TenantPrestaShopConnection;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RuntimeException;
use Throwable;

class CmsCategoryResource extends Resource
{
    protected static bool $isScopedToTenant = false;

    protected static ?string $model = TenantPrestaShopProduct::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-folder-open';

    protected static string|\UnitEnum|null $navigationGroup = 'CMS';

    protected static ?int $navigationSort = 41;

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        self::performanceProbe()->boot('cms_categories');

        return $table
            ->defaultSort('position', 'asc')
            ->defaultKeySort(false)
            ->defaultPaginationPageOption(50)
            ->paginationPageOptions([25, 50, 100])
            ->columns([
                TextColumn::make('id_cms_category')
                    ->label(__('saas.resources.cms_categories.table.columns.id'))
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('saas.resources.cms_categories.table.columns.name'))
                    ->searchable(false)
                    ->sortable(),
                TextColumn::make('parent_name')
                    ->label(__('saas.resources.cms_categories.table.columns.parent'))
                    ->searchable(false)
                    ->sortable(),
                IconColumn::make('active')
                    ->label(__('saas.resources.cms_categories.table.columns.active'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('position')
                    ->label(__('saas.resources.cms_categories.table.columns.position'))
                    ->sortable(),
                TextColumn::make('level_depth')
                    ->label(__('saas.resources.cms_categories.table.columns.level_depth'))
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('id_lang')
                    ->label(__('saas.resources.cms_categories.fields.language'))
                    ->options(fn (): array => self::languageOptions())
                    ->default(fn (): int => self::defaultLanguageId())
                    ->query(fn (Builder $query): Builder => $query),
            ])
            ->recordActions([
                Action::make('editCategory')
                    ->label(__('saas.resources.cms_categories.table.actions.edit'))
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(function (TenantPrestaShopProduct $record): array {
                        $langId = self::resolveTableLanguageId();
                        $categoryId = (int) data_get($record, 'id_cms_category', 0);

                        try {
                            $category = app(TenantPrestaShopCmsCategoryService::class)->getCategory($categoryId, $langId);
                        } catch (RuntimeException) {
                            $category = self::emptyCategory();
                        }

                        return [
                            'id_cms_category' => $categoryId,
                            'id_lang' => $langId,
                            ...$category,
                        ];
                    })
                    ->form(self::cmsCategoryFormSchema(true))
                    ->action(function (array $data): void {
                        try {
                            app(TenantPrestaShopCmsCategoryService::class)->updateCategory(
                                categoryId: (int) ($data['id_cms_category'] ?? 0),
                                langId: (int) ($data['id_lang'] ?? 0),
                                payload: $data,
                            );

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.cms_categories.notifications.update_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.cms_categories.notifications.update_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
            ])
            ->emptyStateHeading(__('saas.resources.cms_categories.table.empty_state_heading'));
    }

    public static function getNavigationLabel(): string
    {
        return __('saas.resources.cms_categories.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('saas.resources.cms_categories.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('saas.resources.cms_categories.plural_model_label');
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ManageCmsCategories::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        if (! self::hasValidTenantContext()) {
            return false;
        }

        $user = self::resolveGateUser();

        if (! $user instanceof User) {
            return false;
        }

        return Gate::forUser($user)->allows('view-tenant-products');
    }

    public static function canCreate(): bool
    {
        return self::canViewAny();
    }

    public static function canEdit(mixed $record): bool
    {
        return self::canViewAny();
    }

    public static function canDelete(mixed $record): bool
    {
        return false;
    }

    /**
     * @return Builder<Model>
     */
    public static function getEloquentQuery(): Builder
    {
        if (! self::hasValidTenantContext()) {
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }

        $probe = self::performanceProbe();
        $probe->boot('cms_categories');
        $setupStartedAt = microtime(true);

        $langId = self::resolveTableLanguageId();
        $connection = app(TenantPrestaShopConnection::class);

        $categoryTable = $connection->table('cms_category');
        $categoryLangTable = $connection->table('cms_category_lang');

        $query = parent::getEloquentQuery()
            ->from($categoryTable.' as c')
            ->leftJoin($categoryLangTable.' as cl', function ($join) use ($langId): void {
                $join
                    ->on('cl.id_cms_category', '=', 'c.id_cms_category')
                    ->where('cl.id_lang', '=', $langId);
            })
            ->leftJoin($categoryTable.' as p', 'p.id_cms_category', '=', 'c.id_parent')
            ->leftJoin($categoryLangTable.' as pl', function ($join) use ($langId): void {
                $join
                    ->on('pl.id_cms_category', '=', 'p.id_cms_category')
                    ->where('pl.id_lang', '=', $langId);
            })
            ->select([
                'c.id_cms_category',
                'c.id_cms_category as id_product',
                'c.id_parent',
                'c.level_depth',
                'c.active',
                'c.position',
                'c.date_add',
                'c.date_upd',
                'cl.name',
                'pl.name as parent_name',
            ]);

        $probe->logTiming('cms_categories.list_query_setup', (microtime(true) - $setupStartedAt) * 1000, [
            'lang_id' => $langId,
        ]);

        $mainQueryStartedAt = null;
        $query->getQuery()->beforeQuery(function () use (&$mainQueryStartedAt): void {
            $mainQueryStartedAt = microtime(true);
        });
        $query->getQuery()->afterQuery(function () use (&$mainQueryStartedAt, $probe): void {
            if (! is_float($mainQueryStartedAt)) {
                return;
            }

            $probe->logTiming('cms_categories.main_query_execute', (microtime(true) - $mainQueryStartedAt) * 1000);
            $mainQueryStartedAt = null;
        });

        return $query;
    }

    /**
     * @return array<int, Hidden|Select|TextInput|Toggle>
     */
    public static function cmsCategoryFormSchema(bool $editing = false): array
    {
        return [
            Hidden::make('id_cms_category')
                ->visible($editing),
            Select::make('id_lang')
                ->label(__('saas.resources.cms_categories.fields.language'))
                ->options(fn (): array => self::languageOptions())
                ->required()
                ->live(),
            TextInput::make('name')
                ->label(__('saas.resources.cms_categories.fields.name'))
                ->required()
                ->maxLength(255),
            Select::make('id_parent')
                ->label(__('saas.resources.cms_categories.fields.parent'))
                ->options(function (Get $get): array {
                    $langId = (int) ($get('id_lang') ?? 0);
                    $categoryId = (int) ($get('id_cms_category') ?? 0);
                    $resolvedLangId = $langId > 0 ? $langId : self::defaultLanguageId();

                    if ($resolvedLangId < 1) {
                        return [];
                    }

                    try {
                        $service = app(TenantPrestaShopCmsCategoryService::class);
                        $options = self::performanceProbe()->measure('cms_categories.category_options', function () use ($service, $resolvedLangId): array {
                            return $service->getCategoryOptions($resolvedLangId);
                        }, ['lang_id' => $resolvedLangId]);

                        if ($categoryId > 0) {
                            $disallowedParentIds = $service->getDisallowedParentIds($categoryId);

                            foreach ($disallowedParentIds as $disallowedParentId) {
                                unset($options[$disallowedParentId]);
                            }
                        }

                        return $options;
                    } catch (Throwable) {
                        return [];
                    }
                })
                ->searchable()
                ->default(0),
            Toggle::make('active')
                ->label(__('saas.resources.cms_categories.fields.active'))
                ->default(true)
                ->required(),
            TextInput::make('position')
                ->label(__('saas.resources.cms_categories.fields.position'))
                ->numeric()
                ->minValue(0)
                ->nullable(),
        ];
    }

    /**
     * @return array{id_parent:int,level_depth:int,active:bool,position:int,name:string,parent_name:string,date_add:?string,date_upd:?string}
     */
    private static function emptyCategory(): array
    {
        return [
            'id_parent' => 0,
            'level_depth' => 0,
            'active' => true,
            'position' => 0,
            'name' => '',
            'parent_name' => '',
            'date_add' => null,
            'date_upd' => null,
        ];
    }

    /**
     * @return array<int, string>
     */
    private static function languageOptions(): array
    {
        if (! self::hasValidTenantContext()) {
            return [];
        }

        return self::rememberInRequest('cms_categories.language_options', function (): array {
            return self::performanceProbe()->measure('cms_categories.language_options', function (): array {
                try {
                    return app(TenantPrestaShopCmsPageService::class)->getLanguageOptions();
                } catch (Throwable) {
                    return [];
                }
            });
        });
    }

    private static function defaultLanguageId(): int
    {
        if (! self::hasValidTenantContext()) {
            return 0;
        }

        return self::rememberInRequest('cms_categories.default_language_id', function (): int {
            return self::performanceProbe()->measure('cms_categories.default_language_id', function (): int {
                try {
                    return app(TenantPrestaShopCmsPageService::class)->resolveDefaultLanguageId();
                } catch (Throwable) {
                    return 0;
                }
            });
        });
    }

    private static function resolveTableLanguageId(): int
    {
        $filterLanguage = (int) data_get(request()->input('tableFilters', []), 'id_lang.value', 0);

        if ($filterLanguage > 0) {
            return $filterLanguage;
        }

        return self::defaultLanguageId();
    }

    private static function hasValidTenantContext(): bool
    {
        $tenantId = app(TenantContext::class)->tenantId();

        return is_int($tenantId) && $tenantId > 0;
    }

    private static function resolveGateUser(): ?User
    {
        $tenantUser = Auth::guard('tenant')->user();

        if ($tenantUser instanceof User) {
            return $tenantUser;
        }

        $webUser = Auth::guard('web')->user();

        return $webUser instanceof User ? $webUser : null;
    }

    private static function performanceProbe(): CmsPerformanceProbe
    {
        return app(CmsPerformanceProbe::class);
    }

    /**
     * @template T
     *
     * @param  callable():T  $resolver
     * @return T
     */
    private static function rememberInRequest(string $key, callable $resolver): mixed
    {
        $request = self::resolveRequest();

        if (! $request instanceof Request) {
            return $resolver();
        }

        if ($request->attributes->has($key)) {
            /** @var T */
            return $request->attributes->get($key);
        }

        $value = $resolver();
        $request->attributes->set($key, $value);

        return $value;
    }

    private static function resolveRequest(): ?Request
    {
        $request = app()->bound('request') ? app('request') : null;

        return $request instanceof Request ? $request : null;
    }
}
