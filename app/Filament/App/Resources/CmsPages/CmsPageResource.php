<?php

namespace App\Filament\App\Resources\CmsPages;

use App\Filament\App\Resources\CmsPages\Pages\ManageCmsPages;
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
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
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

class CmsPageResource extends Resource
{
    protected static bool $isScopedToTenant = false;

    protected static ?string $model = TenantPrestaShopProduct::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static string|\UnitEnum|null $navigationGroup = 'CMS';

    protected static ?int $navigationSort = 40;

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        self::performanceProbe()->boot('cms_pages');

        return $table
            ->defaultSort('position', 'asc')
            ->defaultKeySort(false)
            ->reorderable('position', self::hasPositionColumn())
            ->defaultPaginationPageOption(50)
            ->paginationPageOptions([25, 50, 100])
            ->columns([
                TextColumn::make('id_cms')
                    ->label(__('saas.resources.cms_pages.table.columns.id'))
                    ->sortable(),
                TextColumn::make('meta_title')
                    ->label(__('saas.resources.cms_pages.table.columns.meta_title'))
                    ->wrap()
                    ->searchable(false)
                    ->sortable(),
                TextColumn::make('category_name')
                    ->label(__('saas.resources.cms_pages.table.columns.category'))
                    ->searchable(false)
                    ->sortable(),
                IconColumn::make('active')
                    ->label(__('saas.resources.cms_pages.table.columns.active'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('position')
                    ->label(__('saas.resources.cms_pages.table.columns.position'))
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('id_lang')
                    ->label(__('saas.resources.cms_pages.fields.language'))
                    ->options(fn (): array => self::languageOptions())
                    ->default(fn (): int => self::defaultLanguageId())
                    ->query(fn (Builder $query): Builder => $query),
                SelectFilter::make('id_cms_category')
                    ->label(__('saas.resources.cms_pages.fields.category'))
                    ->options(fn (): array => self::categoryOptions(self::resolveTableLanguageId()))
                    ->searchable()
                    ->query(function (Builder $query, array $data): Builder {
                        $categoryId = (int) ($data['value'] ?? 0);

                        if ($categoryId < 1) {
                            return $query;
                        }

                        return $query->where('c.id_cms_category', $categoryId);
                    }),
            ])
            ->recordActions([
                Action::make('editContent')
                    ->label(__('saas.resources.cms_pages.table.actions.edit'))
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(function (TenantPrestaShopProduct $record): array {
                        $langId = self::resolveTableLanguageId();
                        $cmsId = (int) data_get($record, 'id_cms', 0);

                        try {
                            $page = app(TenantPrestaShopCmsPageService::class)->getPage($cmsId, $langId);
                        } catch (RuntimeException) {
                            $page = self::emptyPage();
                        }

                        return [
                            'id_cms' => $cmsId,
                            'id_lang' => $langId,
                            ...$page,
                        ];
                    })
                    ->form(self::cmsFormSchema(true))
                    ->action(function (array $data): void {
                        try {
                            app(TenantPrestaShopCmsPageService::class)->upsertPage(
                                langId: (int) ($data['id_lang'] ?? 0),
                                payload: $data,
                                cmsId: (int) ($data['id_cms'] ?? 0),
                            );

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.cms_pages.notifications.update_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.cms_pages.notifications.update_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
            ])
            ->emptyStateHeading(__('saas.resources.cms_pages.table.empty_state_heading'));
    }

    public static function getNavigationLabel(): string
    {
        return __('saas.resources.cms_pages.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('saas.resources.cms_pages.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('saas.resources.cms_pages.plural_model_label');
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ManageCmsPages::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
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
        $probe->boot('cms_pages');

        $setupStartedAt = microtime(true);
        $langId = self::resolveTableLanguageId();
        $cmsService = app(TenantPrestaShopCmsPageService::class);
        $connection = app(TenantPrestaShopConnection::class);

        $cmsTable = $connection->table('cms');
        $cmsLangTable = $connection->table('cms_lang');
        $categoryLangTable = $connection->table('cms_category_lang');

        $query = parent::getEloquentQuery()
            ->from($cmsTable.' as c')
            ->leftJoin($cmsLangTable.' as cl', function ($join) use ($langId, $cmsService): void {
                $join
                    ->on('cl.id_cms', '=', 'c.id_cms')
                    ->where('cl.id_lang', '=', $langId);

                if ($cmsService->hasCmsLangColumn('id_shop')) {
                    $join->where('cl.id_shop', '=', $cmsService->resolveReadShopId());
                }
            })
            ->leftJoin($categoryLangTable.' as ccl', function ($join) use ($langId): void {
                $join
                    ->on('ccl.id_cms_category', '=', 'c.id_cms_category')
                    ->where('ccl.id_lang', '=', $langId);
            })
            ->select([
                'c.id_cms',
                'c.id_cms as id_product',
                'c.id_cms_category',
                'c.active',
                'c.position',
                'cl.meta_title',
                'cl.link_rewrite',
                'ccl.name as category_name',
            ]);

        if ($cmsService->hasCmsColumn('indexation')) {
            $query->addSelect('c.indexation');
        }

        $probe->logTiming('cms_pages.list_query_setup', (microtime(true) - $setupStartedAt) * 1000, [
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

            $probe->logTiming('cms_pages.main_query_execute', (microtime(true) - $mainQueryStartedAt) * 1000);
            $mainQueryStartedAt = null;
        });

        return $query;
    }

    /**
     * @return array<int, Hidden|RichEditor|Select|TextInput|Toggle>
     */
    public static function cmsFormSchema(bool $editing = false): array
    {
        $hasIndexation = self::hasIndexationColumn();

        return [
            Hidden::make('id_cms')
                ->visible($editing),
            Select::make('id_lang')
                ->label(__('saas.resources.cms_pages.fields.language'))
                ->options(fn (): array => self::languageOptions())
                ->required()
                ->live()
                ->afterStateUpdated(function (Set $set, Get $get, mixed $state) use ($editing): void {
                    if (! $editing) {
                        return;
                    }

                    $langId = (int) $state;
                    $cmsId = (int) $get('id_cms');

                    if ($langId < 1 || $cmsId < 1) {
                        return;
                    }

                    try {
                        $page = app(TenantPrestaShopCmsPageService::class)->getPage($cmsId, $langId);
                    } catch (RuntimeException) {
                        $page = self::emptyPage();
                    }

                    $set('id_cms_category', $page['id_cms_category']);
                    $set('active', $page['active']);
                    $set('position', $page['position']);
                    $set('indexation', $page['indexation']);
                    $set('meta_title', $page['meta_title']);
                    $set('meta_description', $page['meta_description']);
                    $set('meta_keywords', $page['meta_keywords']);
                    $set('link_rewrite', $page['link_rewrite']);
                    $set('content', $page['content']);
                }),
            Select::make('id_cms_category')
                ->label(__('saas.resources.cms_pages.fields.category'))
                ->options(fn (Get $get): array => self::categoryOptions((int) ($get('id_lang') ?? 0)))
                ->searchable()
                ->required(),
            Toggle::make('active')
                ->label(__('saas.resources.cms_pages.fields.active'))
                ->default(true)
                ->required(),
            TextInput::make('position')
                ->label(__('saas.resources.cms_pages.fields.position'))
                ->numeric()
                ->nullable(),
            Toggle::make('indexation')
                ->label(__('saas.resources.cms_pages.fields.indexation'))
                ->visible($hasIndexation)
                ->default(true),
            TextInput::make('meta_title')
                ->label(__('saas.resources.cms_pages.fields.meta_title'))
                ->required()
                ->maxLength(255),
            TextInput::make('link_rewrite')
                ->label(__('saas.resources.cms_pages.fields.link_rewrite'))
                ->required()
                ->maxLength(128)
                ->rule('regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'),
            TextInput::make('meta_description')
                ->label(__('saas.resources.cms_pages.fields.meta_description'))
                ->maxLength(255)
                ->nullable(),
            TextInput::make('meta_keywords')
                ->label(__('saas.resources.cms_pages.fields.meta_keywords'))
                ->nullable(),
            RichEditor::make('content')
                ->label(__('saas.resources.cms_pages.fields.content')),
        ];
    }

    /**
     * @return array{id_cms_category:int,active:bool,position:?int,indexation:?bool,meta_title:string,meta_description:?string,meta_keywords:?string,link_rewrite:string,content:?string}
     */
    private static function emptyPage(): array
    {
        return [
            'id_cms_category' => 0,
            'active' => true,
            'position' => null,
            'indexation' => null,
            'meta_title' => '',
            'meta_description' => null,
            'meta_keywords' => null,
            'link_rewrite' => '',
            'content' => null,
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

        return self::rememberInRequest('cms_pages.language_options', function (): array {
            return self::performanceProbe()->measure('cms_pages.language_options', function (): array {
                try {
                    return app(TenantPrestaShopCmsPageService::class)->getLanguageOptions();
                } catch (Throwable) {
                    return [];
                }
            });
        });
    }

    /**
     * @return array<int, string>
     */
    private static function categoryOptions(int $langId): array
    {
        if (! self::hasValidTenantContext()) {
            return [];
        }

        $resolvedLangId = $langId > 0 ? $langId : self::defaultLanguageId();

        return self::performanceProbe()->measure('cms_pages.category_options', function () use ($resolvedLangId): array {
            try {
                return app(TenantPrestaShopCmsCategoryService::class)->getCategoryOptions($resolvedLangId);
            } catch (Throwable) {
                return [];
            }
        }, ['lang_id' => $resolvedLangId]);
    }

    private static function defaultLanguageId(): int
    {
        if (! self::hasValidTenantContext()) {
            return 0;
        }

        return self::rememberInRequest('cms_pages.default_language_id', function (): int {
            return self::performanceProbe()->measure('cms_pages.default_language_id', function (): int {
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

    private static function hasIndexationColumn(): bool
    {
        if (! self::hasValidTenantContext()) {
            return false;
        }

        return self::rememberInRequest('cms_pages.has_indexation_column', function (): bool {
            return self::performanceProbe()->measure('cms_pages.has_indexation_column', function (): bool {
                try {
                    return app(TenantPrestaShopCmsPageService::class)->hasCmsColumn('indexation');
                } catch (Throwable) {
                    return false;
                }
            });
        });
    }

    private static function hasPositionColumn(): bool
    {
        if (! self::hasValidTenantContext()) {
            return false;
        }

        return self::rememberInRequest('cms_pages.has_position_column', function (): bool {
            return self::performanceProbe()->measure('cms_pages.has_position_column', function (): bool {
                try {
                    return app(TenantPrestaShopCmsPageService::class)->hasCmsColumn('position');
                } catch (Throwable) {
                    return false;
                }
            });
        });
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

    private static function performanceProbe(): CmsPerformanceProbe
    {
        return app(CmsPerformanceProbe::class);
    }

    private static function resolveRequest(): ?Request
    {
        $request = app()->bound('request') ? app('request') : null;

        return $request instanceof Request ? $request : null;
    }
}
