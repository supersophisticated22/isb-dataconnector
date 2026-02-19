<?php

namespace App\Filament\App\Pages;

use App\Models\Tenant;
use App\Models\TenantUser;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopConnection;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TenantSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $slug = 'settings';

    protected string $view = 'filament.saas.pages.tenant-settings';

    /**
     * @var array<string, mixed>
     */
    public ?array $data = [];

    public function mount(): void
    {
        abort_unless(static::canAccess(), 403);

        $tenant = $this->resolveTenant();

        abort_if($tenant === null, 404);

        $this->form->fill($this->tenantDataForForm($tenant));
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public static function canAccess(): bool
    {
        $tenantUser = Auth::guard('tenant')->user();

        return $tenantUser instanceof TenantUser && $tenantUser->can('manage-tenant-settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('saas.pages.tenant_settings.navigation_label');
    }

    public function getTitle(): string
    {
        return __('saas.pages.tenant_settings.title');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                TextInput::make('db_host')
                    ->label(__('saas.pages.tenant_settings.fields.db_host'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('db_port')
                    ->label(__('saas.pages.tenant_settings.fields.db_port'))
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(65535),
                TextInput::make('db_name')
                    ->label(__('saas.pages.tenant_settings.fields.db_name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('db_user')
                    ->label(__('saas.pages.tenant_settings.fields.db_user'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('db_password')
                    ->label(__('saas.pages.tenant_settings.fields.db_password'))
                    ->password()
                    ->revealable(false)
                    ->autocomplete('new-password')
                    ->helperText(__('saas.pages.tenant_settings.password_hint'))
                    ->maxLength(255),
                TextInput::make('db_prefix')
                    ->label(__('saas.pages.tenant_settings.fields.db_prefix'))
                    ->required()
                    ->maxLength(20),
                TextInput::make('base_shop_url')
                    ->label(__('saas.pages.tenant_settings.fields.base_shop_url'))
                    ->readOnly()
                    ->dehydrated(false),
            ]);
    }

    /**
     * @return array<Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('testConnection')
                ->label(__('saas.pages.tenant_settings.actions.test_connection'))
                ->action(function (TenantPrestaShopConnection $tenantPrestaShopConnection): void {
                    $tenant = $this->resolveTenantForConnection();

                    if ($tenant === null) {
                        $this->sendErrorNotification(__('saas.pages.tenant_settings.notifications.no_tenant'));

                        return;
                    }

                    $isConnected = $tenantPrestaShopConnection->testConnection($tenant);

                    if (! $isConnected) {
                        $this->sendErrorNotification(__('saas.pages.tenant_settings.notifications.connection_failed'));

                        return;
                    }

                    Notification::make()
                        ->success()
                        ->title(__('saas.pages.tenant_settings.notifications.connection_success'))
                        ->send();
                }),
            Action::make('syncShopUrl')
                ->label(__('saas.pages.tenant_settings.actions.sync_shop_url'))
                ->action(function (TenantPrestaShopConnection $tenantPrestaShopConnection): void {
                    $tenant = $this->resolveTenant();

                    if ($tenant === null) {
                        $this->sendErrorNotification(__('saas.pages.tenant_settings.notifications.no_tenant'));

                        return;
                    }

                    $this->persistTenantSettings(tenant: $tenant, withNotifications: false);

                    $isSynced = $tenantPrestaShopConnection->onboard($tenant);

                    if (! $isSynced) {
                        $this->sendErrorNotification(__('saas.pages.tenant_settings.notifications.sync_failed'));

                        return;
                    }

                    $this->form->fill($this->tenantDataForForm($tenant->fresh() ?? $tenant));

                    Notification::make()
                        ->success()
                        ->title(__('saas.pages.tenant_settings.notifications.sync_success'))
                        ->send();
                }),
        ];
    }

    public function save(): void
    {
        $tenant = $this->resolveTenant();

        if ($tenant === null) {
            $this->sendErrorNotification(__('saas.pages.tenant_settings.notifications.no_tenant'));

            return;
        }

        $this->persistTenantSettings(tenant: $tenant, withNotifications: true);
    }

    private function persistTenantSettings(Tenant $tenant, bool $withNotifications): void
    {
        /** @var array{
         *     db_host:string,
         *     db_port:int|string,
         *     db_name:string,
         *     db_user:string,
         *     db_password?:?string,
         *     db_prefix:string
         * } $state
         */
        $state = $this->form->getState();

        /** @var array<string, mixed> $attributes */
        $attributes = [
            'db_host' => $state['db_host'],
            'db_port' => (int) $state['db_port'],
            'db_name' => $state['db_name'],
            'db_user' => $state['db_user'],
            'db_prefix' => $state['db_prefix'],
        ];

        $newPassword = $state['db_password'] ?? null;

        if (is_string($newPassword) && $newPassword !== '') {
            $attributes['db_password'] = $newPassword;
        }

        $tenant->forceFill($attributes)->save();

        $this->form->fill($this->tenantDataForForm($tenant->fresh() ?? $tenant));

        if ($withNotifications) {
            Notification::make()
                ->success()
                ->title(__('saas.pages.tenant_settings.notifications.saved'))
                ->send();
        }
    }

    private function sendErrorNotification(string $message): void
    {
        Notification::make()
            ->danger()
            ->title($message)
            ->send();
    }

    private function resolveTenantForConnection(): ?Tenant
    {
        $tenant = $this->resolveTenant();

        if ($tenant === null) {
            return null;
        }

        /** @var array{
         *     db_host:string,
         *     db_port:int|string,
         *     db_name:string,
         *     db_user:string,
         *     db_password?:?string,
         *     db_prefix:string
         * } $state
         */
        $state = $this->form->getState();

        $resolvedPassword = $state['db_password'] ?? null;

        $tenant->setAttribute('db_host', $state['db_host']);
        $tenant->setAttribute('db_port', (int) $state['db_port']);
        $tenant->setAttribute('db_name', $state['db_name']);
        $tenant->setAttribute('db_user', $state['db_user']);
        $tenant->setAttribute('db_prefix', $state['db_prefix']);

        if (is_string($resolvedPassword) && $resolvedPassword !== '') {
            $tenant->setAttribute('db_password', $resolvedPassword);
        }

        return $tenant;
    }

    /**
     * @return array<string, mixed>
     */
    private function tenantDataForForm(Tenant $tenant): array
    {
        return [
            'db_host' => $tenant->db_host,
            'db_port' => $tenant->db_port,
            'db_name' => $tenant->db_name,
            'db_user' => $tenant->db_user,
            'db_password' => '',
            'db_prefix' => $tenant->db_prefix,
            'base_shop_url' => $tenant->base_shop_url,
        ];
    }

    private function resolveTenant(): ?Tenant
    {
        $tenant = app(TenantContext::class)->getTenant();

        if ($tenant instanceof Tenant) {
            return $tenant;
        }

        $tenantUser = Auth::guard('tenant')->user();

        if (! $tenantUser instanceof TenantUser) {
            return null;
        }

        return $tenantUser->tenant()->first();
    }
}
