<?php

namespace App\Filament\App\Resources\BlogReplies;

use App\Filament\App\Resources\BlogReplies\Pages\ManageBlogReplies;
use App\Models\TenantPrestaShopProduct;
use App\Models\User;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopBlogReplyService;
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

class BlogReplyResource extends Resource
{
    protected static bool $isScopedToTenant = false;

    protected static ?string $model = TenantPrestaShopProduct::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static string|\UnitEnum|null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 52;

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id_reply', 'desc')
            ->defaultKeySort(false)
            ->defaultPaginationPageOption(50)
            ->paginationPageOptions([25, 50, 100])
            ->columns([
                TextColumn::make('id_reply')
                    ->label(__('saas.resources.blog_replies.table.columns.id'))
                    ->sortable(),
                TextColumn::make('id_comment')
                    ->label(__('saas.resources.blog_replies.table.columns.comment_id'))
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('saas.resources.blog_replies.table.columns.name'))
                    ->searchable(false)
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('saas.resources.blog_replies.table.columns.email'))
                    ->searchable(false)
                    ->sortable(),
                IconColumn::make('approved')
                    ->label(__('saas.resources.blog_replies.table.columns.approved'))
                    ->boolean()
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('editReply')
                    ->label(__('saas.resources.blog_replies.table.actions.edit'))
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(function (TenantPrestaShopProduct $record): array {
                        $replyId = (int) data_get($record, 'id_reply', 0);

                        try {
                            $reply = app(TenantPrestaShopBlogReplyService::class)->getReply($replyId);
                        } catch (RuntimeException) {
                            $reply = self::emptyReply();
                        }

                        return [
                            'id_reply' => $replyId,
                            ...$reply,
                        ];
                    })
                    ->form(self::blogReplyFormSchema(true))
                    ->action(function (array $data): void {
                        try {
                            app(TenantPrestaShopBlogReplyService::class)->updateReply(
                                replyId: (int) ($data['id_reply'] ?? 0),
                                payload: $data,
                            );

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.blog_replies.notifications.update_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.blog_replies.notifications.update_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
                Action::make('deleteReply')
                    ->label(__('saas.resources.blog_replies.table.actions.delete'))
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (TenantPrestaShopProduct $record): void {
                        try {
                            app(TenantPrestaShopBlogReplyService::class)->deleteReply((int) data_get($record, 'id_reply', 0));

                            Notification::make()
                                ->success()
                                ->title(__('saas.resources.blog_replies.notifications.delete_success'))
                                ->send();
                        } catch (RuntimeException $exception) {
                            Notification::make()
                                ->danger()
                                ->title(__('saas.resources.blog_replies.notifications.delete_failed'))
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
            ])
            ->emptyStateHeading(__('saas.resources.blog_replies.table.empty_state_heading'));
    }

    public static function getNavigationLabel(): string
    {
        return __('saas.resources.blog_replies.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('saas.resources.blog_replies.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('saas.resources.blog_replies.plural_model_label');
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ManageBlogReplies::route('/'),
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

        $connection = app(TenantPrestaShopConnection::class);
        $replyTable = $connection->table('ets_blog_reply');

        return parent::getEloquentQuery()
            ->from($replyTable.' as r')
            ->select([
                'r.id_reply',
                'r.id_reply as id_product',
                'r.id_comment',
                'r.id_user',
                'r.name',
                'r.email',
                'r.reply',
                'r.id_employee',
                'r.approved',
                'r.date_add',
                'r.date_upd',
            ]);
    }

    /**
     * @return array<int, Hidden|Textarea|TextInput|Toggle>
     */
    public static function blogReplyFormSchema(bool $editing = false): array
    {
        return [
            Hidden::make('id_reply')
                ->visible($editing),
            TextInput::make('id_comment')
                ->label(__('saas.resources.blog_replies.fields.comment_id'))
                ->numeric()
                ->required()
                ->minValue(1),
            TextInput::make('id_user')
                ->label(__('saas.resources.blog_replies.fields.user_id'))
                ->numeric()
                ->default(0)
                ->minValue(0),
            TextInput::make('name')
                ->label(__('saas.resources.blog_replies.fields.name'))
                ->required()
                ->maxLength(5000),
            TextInput::make('email')
                ->label(__('saas.resources.blog_replies.fields.email'))
                ->email()
                ->required()
                ->maxLength(5000),
            Textarea::make('reply')
                ->label(__('saas.resources.blog_replies.fields.reply')),
            TextInput::make('id_employee')
                ->label(__('saas.resources.blog_replies.fields.employee_id'))
                ->numeric()
                ->default(0)
                ->minValue(0),
            Toggle::make('approved')
                ->label(__('saas.resources.blog_replies.fields.approved'))
                ->default(false),
        ];
    }

    /**
     * @return array{id_comment:int,id_user:int,name:string,email:string,reply:?string,id_employee:int,approved:?int}
     */
    private static function emptyReply(): array
    {
        return [
            'id_comment' => 0,
            'id_user' => 0,
            'name' => '',
            'email' => '',
            'reply' => null,
            'id_employee' => 0,
            'approved' => 0,
        ];
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
