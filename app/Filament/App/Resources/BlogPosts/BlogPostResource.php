<?php

namespace App\Filament\App\Resources\BlogPosts;

use App\Filament\App\Resources\BlogPosts\Pages\ManageBlogPosts;
use App\Models\TenantPrestaShopProduct;
use App\Models\User;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopBlogCategoryService;
use App\Services\TenantPrestaShopBlogPostService;
use App\Services\TenantPrestaShopConnection;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RuntimeException;
use Throwable;

class BlogPostResource extends Resource
{
    protected static bool $isScopedToTenant = false;

    protected static ?string $model = TenantPrestaShopProduct::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static string|\UnitEnum|null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 51;

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order', 'asc')
            ->defaultKeySort(false)
            ->defaultPaginationPageOption(25)
            ->paginationPageOptions([25, 50, 100])
            ->columns([
                TextColumn::make('id_post')
                    ->label(__('saas.resources.blog_posts.table.columns.id'))
                    ->sortable(),
                TextColumn::make('title')
                    ->label(__('saas.resources.blog_posts.table.columns.title'))
                    ->searchable(false)
                    ->sortable(),
                TextColumn::make('category_title')
                    ->label(__('saas.resources.blog_posts.table.columns.category'))
                    ->searchable(false)
                    ->sortable(),
                IconColumn::make('enabled')
                    ->label(__('saas.resources.blog_posts.table.columns.enabled'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label(__('saas.resources.blog_posts.table.columns.sort_order'))
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('editPost')
                    ->label(__('saas.resources.blog_posts.table.actions.edit'))
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(function (TenantPrestaShopProduct $record): array {
                        $postId = (int) data_get($record, 'id_post', 0);

                        try {
                            $post = app(TenantPrestaShopBlogPostService::class)->getPost($postId);
                        } catch (RuntimeException) {
                            $post = self::emptyPost();
                        }

                        return [
                            'id_post' => $postId,
                            ...$post,
                        ];
                    })
                    ->form(self::blogPostFormSchema(true))
                    ->action(function (array $data): void {
                        try {
                            app(TenantPrestaShopBlogPostService::class)->updatePost(
                                postId: (int) ($data['id_post'] ?? 0),
                                payload: $data,
                            );

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.blog_posts.notifications.update_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.blog_posts.notifications.update_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
                Action::make('deletePost')
                    ->label(__('saas.resources.blog_posts.table.actions.delete'))
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (TenantPrestaShopProduct $record): void {
                        try {
                            app(TenantPrestaShopBlogPostService::class)->deletePost((int) data_get($record, 'id_post', 0));

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.blog_posts.notifications.delete_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.blog_posts.notifications.delete_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
            ])
            ->emptyStateHeading(__('saas.resources.blog_posts.table.empty_state_heading'));
    }

    public static function getNavigationLabel(): string
    {
        return __('saas.resources.blog_posts.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('saas.resources.blog_posts.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('saas.resources.blog_posts.plural_model_label');
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ManageBlogPosts::route('/'),
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

        $postTable = $connection->table('ets_blog_post');
        $postLangTable = $connection->table('ets_blog_post_lang');
        $categoryLangTable = $connection->table('ets_blog_category_lang');

        return parent::getEloquentQuery()
            ->from($postTable.' as p')
            ->leftJoin($postLangTable.' as pl', function ($join) use ($langId): void {
                $join
                    ->on('pl.id_post', '=', 'p.id_post')
                    ->where('pl.id_lang', '=', $langId);
            })
            ->leftJoin($categoryLangTable.' as cl', function ($join) use ($langId): void {
                $join
                    ->on('cl.id_category', '=', 'p.id_category_default')
                    ->where('cl.id_lang', '=', $langId);
            })
            ->select([
                'p.id_post',
                'p.id_post as id_product',
                'p.enabled',
                'p.sort_order',
                'pl.title',
                'cl.title as category_title',
            ]);
    }

    /**
     * @return array<int, Hidden|Select|Textarea|TextInput|Toggle>
     */
    public static function blogPostFormSchema(bool $editing = false): array
    {
        return [
            Hidden::make('id_post')
                ->visible($editing),
            TextInput::make('title')
                ->label(__('saas.resources.blog_posts.fields.title'))
                ->required()
                ->maxLength(2000),
            Select::make('id_category_default')
                ->label(__('saas.resources.blog_posts.fields.default_category'))
                ->options(fn (): array => self::categoryOptions())
                ->searchable()
                ->required(),
            Select::make('category_ids')
                ->label(__('saas.resources.blog_posts.fields.categories'))
                ->multiple()
                ->options(fn (): array => self::categoryOptions())
                ->searchable()
                ->required(),
            Toggle::make('enabled')
                ->label(__('saas.resources.blog_posts.fields.enabled'))
                ->default(true)
                ->required(),
            Toggle::make('is_customer')
                ->label(__('saas.resources.blog_posts.fields.is_customer'))
                ->default(false),
            TextInput::make('sort_order')
                ->label(__('saas.resources.blog_posts.fields.sort_order'))
                ->numeric()
                ->default(1)
                ->minValue(1)
                ->required(),
            TextInput::make('url_alias')
                ->label(__('saas.resources.blog_posts.fields.url_alias'))
                ->maxLength(700),
            TextInput::make('meta_title')
                ->label(__('saas.resources.blog_posts.fields.meta_title'))
                ->maxLength(700),
            Textarea::make('short_description')
                ->label(__('saas.resources.blog_posts.fields.short_description')),
            Textarea::make('description')
                ->label(__('saas.resources.blog_posts.fields.description')),
            TextInput::make('meta_keywords')
                ->label(__('saas.resources.blog_posts.fields.meta_keywords'))
                ->maxLength(5000),
            Textarea::make('meta_description')
                ->label(__('saas.resources.blog_posts.fields.meta_description')),
            TextInput::make('thumb')
                ->label(__('saas.resources.blog_posts.fields.thumb'))
                ->maxLength(1000),
            TextInput::make('image')
                ->label(__('saas.resources.blog_posts.fields.image'))
                ->maxLength(500),
        ];
    }

    /**
     * @return array{
     *     id_category_default:int,
     *     is_customer:bool,
     *     enabled:bool,
     *     sort_order:int,
     *     title:string,
     *     url_alias:string,
     *     meta_title:string,
     *     description:?string,
     *     short_description:?string,
     *     meta_keywords:string,
     *     meta_description:?string,
     *     image:string,
     *     thumb:string,
     *     category_ids:list<int>
     * }
     */
    private static function emptyPost(): array
    {
        return [
            'id_category_default' => 0,
            'is_customer' => false,
            'enabled' => true,
            'sort_order' => 1,
            'title' => '',
            'url_alias' => '',
            'meta_title' => '',
            'description' => null,
            'short_description' => null,
            'meta_keywords' => '',
            'meta_description' => null,
            'image' => '',
            'thumb' => '',
            'category_ids' => [],
        ];
    }

    /**
     * @return array<int, string>
     */
    private static function categoryOptions(): array
    {
        if (! self::hasValidTenantContext()) {
            return [];
        }

        return self::rememberInRequest('blog_posts.category_options', function (): array {
            try {
                return app(TenantPrestaShopBlogCategoryService::class)->getCategoryOptions();
            } catch (Throwable) {
                return [];
            }
        });
    }

    private static function defaultLanguageId(): int
    {
        if (! self::hasValidTenantContext()) {
            return 0;
        }

        return self::rememberInRequest('blog_posts.default_language_id', function (): int {
            try {
                return app(TenantPrestaShopBlogPostService::class)->resolveDefaultLanguageId();
            } catch (Throwable) {
                return 0;
            }
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

    private static function resolveRequest(): ?Request
    {
        $request = app()->bound('request') ? app('request') : null;

        return $request instanceof Request ? $request : null;
    }
}
