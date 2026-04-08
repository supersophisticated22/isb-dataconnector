<?php

namespace App\Filament\App\Resources\BlogCategories;

use App\Filament\App\Resources\BlogCategories\Pages\ManageBlogCategories;
use App\Models\TenantPrestaShopProduct;
use App\Models\User;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopBlogCategoryService;
use App\Services\TenantPrestaShopConnection;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RuntimeException;
use Throwable;

class BlogCategoryResource extends Resource
{
    protected static bool $isScopedToTenant = false;

    protected static ?string $model = TenantPrestaShopProduct::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-folder';

    protected static string|\UnitEnum|null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 50;

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order', 'asc')
            ->defaultKeySort(false)
            ->defaultPaginationPageOption(50)
            ->paginationPageOptions([25, 50, 100])
            ->columns([
                TextColumn::make('id_category')
                    ->label(__('saas.resources.blog_categories.table.columns.id'))
                    ->sortable(),
                TextColumn::make('title')
                    ->label(__('saas.resources.blog_categories.table.columns.title'))
                    ->searchable(false)
                    ->sortable(),
                TextColumn::make('parent_title')
                    ->label(__('saas.resources.blog_categories.table.columns.parent'))
                    ->searchable(false)
                    ->sortable(),
                IconColumn::make('enabled')
                    ->label(__('saas.resources.blog_categories.table.columns.enabled'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label(__('saas.resources.blog_categories.table.columns.sort_order'))
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('editCategory')
                    ->label(__('saas.resources.blog_categories.table.actions.edit'))
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(function (TenantPrestaShopProduct $record): array {
                        $categoryId = (int) data_get($record, 'id_category', 0);

                        try {
                            $category = app(TenantPrestaShopBlogCategoryService::class)->getCategory($categoryId);
                        } catch (RuntimeException) {
                            $category = self::emptyCategory();
                        }

                        return [
                            'id_category' => $categoryId,
                            ...$category,
                        ];
                    })
                    ->form(self::blogCategoryFormSchema(true))
                    ->action(function (array $data): void {
                        try {
                            app(TenantPrestaShopBlogCategoryService::class)->updateCategory(
                                categoryId: (int) ($data['id_category'] ?? 0),
                                payload: $data,
                            );

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.blog_categories.notifications.update_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.blog_categories.notifications.update_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
                Action::make('deleteCategory')
                    ->label(__('saas.resources.blog_categories.table.actions.delete'))
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (TenantPrestaShopProduct $record): void {
                        try {
                            app(TenantPrestaShopBlogCategoryService::class)->deleteCategory((int) data_get($record, 'id_category', 0));

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.blog_categories.notifications.delete_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.blog_categories.notifications.delete_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
            ])
            ->emptyStateHeading(__('saas.resources.blog_categories.table.empty_state_heading'));
    }

    public static function getNavigationLabel(): string
    {
        return __('saas.resources.blog_categories.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('saas.resources.blog_categories.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('saas.resources.blog_categories.plural_model_label');
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ManageBlogCategories::route('/'),
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
        return self::canViewAny();
    }

    /**
     * @return Builder<Model>
     */
    public static function getEloquentQuery(): Builder
    {
        if (! self::hasValidTenantContext()) {
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }

        $langId = self::defaultLanguageId();
        $connection = app(TenantPrestaShopConnection::class);

        $categoryTable = $connection->table('ets_blog_category');
        $categoryLangTable = $connection->table('ets_blog_category_lang');

        return parent::getEloquentQuery()
            ->from($categoryTable.' as c')
            ->leftJoin($categoryLangTable.' as cl', function ($join) use ($langId): void {
                $join
                    ->on('cl.id_category', '=', 'c.id_category')
                    ->where('cl.id_lang', '=', $langId);
            })
            ->leftJoin($categoryTable.' as p', 'p.id_category', '=', 'c.id_parent')
            ->leftJoin($categoryLangTable.' as pl', function ($join) use ($langId): void {
                $join
                    ->on('pl.id_category', '=', 'p.id_category')
                    ->where('pl.id_lang', '=', $langId);
            })
            ->select([
                'c.id_category',
                'c.id_category as id_product',
                'c.id_parent',
                'c.enabled',
                'c.sort_order',
                'c.date_add',
                'c.date_upd',
                'cl.title',
                'cl.url_alias',
                'cl.meta_title',
                'pl.title as parent_title',
            ]);
    }

    /**
     * @return array<int, Hidden|Textarea|TextInput|Toggle>
     */
    public static function blogCategoryFormSchema(bool $editing = false): array
    {
        return [
            Hidden::make('id_category')
                ->visible($editing),
            TextInput::make('title')
                ->label(__('saas.resources.blog_categories.fields.title'))
                ->required()
                ->maxLength(2000),
            TextInput::make('id_parent')
                ->label(__('saas.resources.blog_categories.fields.parent'))
                ->numeric()
                ->default(0)
                ->minValue(0),
            Toggle::make('enabled')
                ->label(__('saas.resources.blog_categories.fields.enabled'))
                ->default(true)
                ->required(),
            TextInput::make('sort_order')
                ->label(__('saas.resources.blog_categories.fields.sort_order'))
                ->numeric()
                ->default(1)
                ->minValue(1)
                ->required(),
            TextInput::make('url_alias')
                ->label(__('saas.resources.blog_categories.fields.url_alias'))
                ->maxLength(700),
            TextInput::make('meta_title')
                ->label(__('saas.resources.blog_categories.fields.meta_title'))
                ->maxLength(2000),
            Textarea::make('description')
                ->label(__('saas.resources.blog_categories.fields.description')),
            TextInput::make('meta_keywords')
                ->label(__('saas.resources.blog_categories.fields.meta_keywords'))
                ->maxLength(5000),
            Textarea::make('meta_description')
                ->label(__('saas.resources.blog_categories.fields.meta_description')),
            TextInput::make('image')
                ->label(__('saas.resources.blog_categories.fields.image'))
                ->maxLength(500),
            TextInput::make('thumb')
                ->label(__('saas.resources.blog_categories.fields.thumb'))
                ->maxLength(500),
        ];
    }

    /**
     * @return array{
     *     id_parent:int,
     *     enabled:bool,
     *     sort_order:int,
     *     title:string,
     *     url_alias:string,
     *     meta_title:string,
     *     description:?string,
     *     meta_keywords:string,
     *     meta_description:?string,
     *     image:?string,
     *     thumb:?string
     * }
     */
    private static function emptyCategory(): array
    {
        return [
            'id_parent' => 0,
            'enabled' => true,
            'sort_order' => 1,
            'title' => '',
            'url_alias' => '',
            'meta_title' => '',
            'description' => null,
            'meta_keywords' => '',
            'meta_description' => null,
            'image' => null,
            'thumb' => null,
        ];
    }

    private static function defaultLanguageId(): int
    {
        if (! self::hasValidTenantContext()) {
            return 0;
        }

        try {
            return app(TenantPrestaShopBlogCategoryService::class)->resolveDefaultLanguageId();
        } catch (Throwable) {
            return 0;
        }
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
}
