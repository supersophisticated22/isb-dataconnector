<?php

namespace App\Filament\App\Pages;

use App\Jobs\StartBulkPriceUpdateJob;
use App\Models\Job;
use App\Models\Tenant;
use App\Models\User;
use App\Services\BulkPriceUpdateService;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopConnection;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BulkPriceUpdate extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-euro';

    protected static ?int $navigationSort = 31;

    protected static ?string $slug = 'products/bulk-price-update';

    protected string $view = 'filament.saas.pages.bulk-price-update';

    /**
     * @var array<string, mixed>
     */
    public ?array $data = [];

    public ?int $previewCount = null;

    /**
     * @var array<string, string>
     */
    public array $manufacturerOptions = [];

    /**
     * @var array<string, string>
     */
    public array $categoryOptions = [];

    public ?Job $latestJob = null;

    public function mount(TenantPrestaShopConnection $tenantPrestaShopConnection): void
    {
        abort_unless(static::canAccess(), 403);

        $tenant = $this->resolveTenant();

        abort_if($tenant === null, 404);

        $tenantPrestaShopConnection->connect($tenant);

        $this->manufacturerOptions = $this->resolveManufacturerOptions($tenantPrestaShopConnection);
        $this->categoryOptions = $this->resolveCategoryOptions($tenantPrestaShopConnection);

        $this->form->fill([
            'manufacturer' => null,
            'category' => null,
            'min_price' => null,
            'max_price' => null,
            'has_discount' => null,
            'direction' => 'increase',
            'value_type' => 'percent',
            'amount' => 5,
        ]);

        $this->loadLatestJob();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public static function canAccess(): bool
    {
        $tenantUser = Auth::guard('tenant')->user();

        return $tenantUser instanceof User && Gate::allows('manage-tenant-bulk-price-updates');
    }

    public static function getNavigationLabel(): string
    {
        return __('saas.pages.bulk_price_update.navigation_label');
    }

    public function getTitle(): string
    {
        return __('saas.pages.bulk_price_update.title');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make(__('saas.pages.bulk_price_update.sections.filters'))
                    ->schema([
                        Select::make('manufacturer')
                            ->label(__('saas.pages.bulk_price_update.fields.manufacturer'))
                            ->options($this->manufacturerOptions)
                            ->searchable(),
                        Select::make('category')
                            ->label(__('saas.pages.bulk_price_update.fields.category'))
                            ->options($this->categoryOptions)
                            ->searchable(),
                        TextInput::make('min_price')
                            ->label(__('saas.pages.bulk_price_update.fields.min_price'))
                            ->numeric()
                            ->minValue(0)
                            ->step(0.000001),
                        TextInput::make('max_price')
                            ->label(__('saas.pages.bulk_price_update.fields.max_price'))
                            ->numeric()
                            ->minValue(0)
                            ->step(0.000001),
                        Select::make('has_discount')
                            ->label(__('saas.pages.bulk_price_update.fields.has_discount'))
                            ->options([
                                '1' => __('saas.pages.bulk_price_update.options.has_discount_yes'),
                                '0' => __('saas.pages.bulk_price_update.options.has_discount_no'),
                            ])
                            ->placeholder(__('saas.pages.bulk_price_update.options.any')),
                    ])
                    ->columns(2),
                Section::make(__('saas.pages.bulk_price_update.sections.action'))
                    ->schema([
                        Select::make('direction')
                            ->label(__('saas.pages.bulk_price_update.fields.direction'))
                            ->options([
                                'increase' => __('saas.pages.bulk_price_update.options.increase'),
                                'decrease' => __('saas.pages.bulk_price_update.options.decrease'),
                            ])
                            ->required()
                            ->default('increase'),
                        Select::make('value_type')
                            ->label(__('saas.pages.bulk_price_update.fields.value_type'))
                            ->options([
                                'percent' => __('saas.pages.bulk_price_update.options.percent'),
                                'fixed' => __('saas.pages.bulk_price_update.options.fixed'),
                            ])
                            ->required()
                            ->default('percent'),
                        TextInput::make('amount')
                            ->label(__('saas.pages.bulk_price_update.fields.amount'))
                            ->numeric()
                            ->required()
                            ->minValue(0.000001)
                            ->step(0.000001),
                    ])
                    ->columns(3),
            ]);
    }

    public function preview(BulkPriceUpdateService $bulkPriceUpdateService): void
    {
        $tenant = $this->resolveTenant();

        if (! $tenant instanceof Tenant) {
            Notification::make()
                ->danger()
                ->title(__('saas.pages.bulk_price_update.notifications.no_tenant'))
                ->send();

            return;
        }

        $filters = $this->resolveFiltersFromState();

        $this->previewCount = $bulkPriceUpdateService->previewCount($tenant->id, $filters);

        Notification::make()
            ->success()
            ->title(__('saas.pages.bulk_price_update.notifications.preview_ready_title'))
            ->body(__('saas.pages.bulk_price_update.notifications.preview_ready_body', ['count' => $this->previewCount]))
            ->send();
    }

    public function enqueue(): void
    {
        $tenant = $this->resolveTenant();
        $tenantUser = Auth::guard('tenant')->user();

        if (! $tenant instanceof Tenant || ! $tenantUser instanceof User) {
            Notification::make()
                ->danger()
                ->title(__('saas.pages.bulk_price_update.notifications.no_tenant'))
                ->send();

            return;
        }

        $filters = $this->resolveFiltersFromState();
        $operation = $this->resolveOperationFromState();

        $job = Job::query()->create([
            'tenant_id' => $tenant->id,
            'created_by_user_id' => null,
            'created_by_tenant_user_id' => $tenantUser->id,
            'type' => 'bulk_price_update_v2',
            'status' => 'queued',
            'progress_current' => 0,
            'progress_total' => max(0, (int) ($this->previewCount ?? 0)),
            'summary' => [
                'filters' => $filters,
                'operation' => $operation,
                'initiator_tenant_user_id' => $tenantUser->id,
                'updated_base_price_count' => 0,
                'created_specific_price_count' => 0,
                'failed_products' => 0,
            ],
        ]);

        StartBulkPriceUpdateJob::dispatch(
            jobId: $job->id,
            tenantId: $tenant->id,
            filters: $filters,
            operation: $operation,
        );

        Notification::make()
            ->success()
            ->title(__('saas.pages.bulk_price_update.notifications.job_queued_title'))
            ->body(__('saas.pages.bulk_price_update.notifications.job_queued_body', ['job_id' => $job->id]))
            ->send();

        $this->loadLatestJob();
    }

    public function cancelLatestJob(): void
    {
        $tenant = $this->resolveTenant();

        if (! $tenant instanceof Tenant) {
            Notification::make()
                ->danger()
                ->title(__('saas.pages.bulk_price_update.notifications.no_tenant'))
                ->send();

            return;
        }

        $job = Job::query()
            ->where('tenant_id', $tenant->id)
            ->where('type', 'bulk_price_update_v2')
            ->whereIn('status', ['queued', 'running'])
            ->latest('id')
            ->first();

        if (! $job instanceof Job) {
            Notification::make()
                ->warning()
                ->title(__('saas.pages.bulk_price_update.notifications.no_active_job'))
                ->send();

            return;
        }

        $summary = is_array($job->summary) ? $job->summary : [];

        $job->forceFill([
            'status' => 'cancelled',
            'finished_at' => now(),
            'summary' => [
                ...$summary,
                'cancelled_at' => now()->toDateTimeString(),
            ],
        ])->save();

        Notification::make()
            ->success()
            ->title(__('saas.pages.bulk_price_update.notifications.job_cancelled_title_local'))
            ->send();

        $this->loadLatestJob();
    }

    private function loadLatestJob(): void
    {
        $tenant = $this->resolveTenant();

        if (! $tenant instanceof Tenant) {
            $this->latestJob = null;

            return;
        }

        $this->latestJob = Job::query()
            ->where('tenant_id', $tenant->id)
            ->where('type', 'bulk_price_update_v2')
            ->latest('id')
            ->first();
    }

    private function resolveTenant(): ?Tenant
    {
        $tenant = app(TenantContext::class)->getTenant();

        if ($tenant instanceof Tenant) {
            return $tenant;
        }

        $tenantUser = Auth::guard('tenant')->user();

        if (! $tenantUser instanceof User) {
            return null;
        }

        return $tenantUser->tenants()
            ->wherePivot('status', 'active')
            ->first();
    }

    /**
     * @return array{manufacturer?:string,category?:string,min_price?:float,max_price?:float,has_discount?:bool}
     */
    private function resolveFiltersFromState(): array
    {
        /** @var array<string, mixed> $state */
        $state = $this->form->getState();

        $filters = [];

        if (is_string($state['manufacturer'] ?? null) && $state['manufacturer'] !== '') {
            $filters['manufacturer'] = $state['manufacturer'];
        }

        if (is_string($state['category'] ?? null) && $state['category'] !== '') {
            $filters['category'] = $state['category'];
        }

        if (is_numeric($state['min_price'] ?? null)) {
            $filters['min_price'] = (float) $state['min_price'];
        }

        if (is_numeric($state['max_price'] ?? null)) {
            $filters['max_price'] = (float) $state['max_price'];
        }

        if (($state['has_discount'] ?? null) === '1') {
            $filters['has_discount'] = true;
        }

        if (($state['has_discount'] ?? null) === '0') {
            $filters['has_discount'] = false;
        }

        return $filters;
    }

    /**
     * @return array{direction:string,value_type:string,amount:float}
     */
    private function resolveOperationFromState(): array
    {
        /** @var array<string, mixed> $state */
        $state = $this->form->getState();

        $direction = (string) ($state['direction'] ?? 'increase');
        $valueType = (string) ($state['value_type'] ?? 'percent');

        return [
            'direction' => in_array($direction, ['increase', 'decrease'], true) ? $direction : 'increase',
            'value_type' => in_array($valueType, ['percent', 'fixed'], true) ? $valueType : 'percent',
            'amount' => max(0.000001, (float) ($state['amount'] ?? 0)),
        ];
    }

    /**
     * @return array<string, string>
     */
    private function resolveManufacturerOptions(TenantPrestaShopConnection $tenantPrestaShopConnection): array
    {
        $manufacturerTable = $tenantPrestaShopConnection->table('manufacturer');

        /** @var list<string> $manufacturers */
        $manufacturers = DB::connection('tenant_ps')
            ->table($manufacturerTable)
            ->orderBy('name')
            ->pluck('name')
            ->filter(fn (mixed $value): bool => is_string($value) && trim($value) !== '')
            ->map(fn (mixed $value): string => (string) $value)
            ->values()
            ->all();

        $options = [];

        foreach ($manufacturers as $manufacturer) {
            $options[$manufacturer] = $manufacturer;
        }

        return $options;
    }

    /**
     * @return array<string, string>
     */
    private function resolveCategoryOptions(TenantPrestaShopConnection $tenantPrestaShopConnection): array
    {
        $categoryProductTable = $tenantPrestaShopConnection->table('category_product');

        /** @var list<string> $categoryIds */
        $categoryIds = DB::connection('tenant_ps')
            ->table($categoryProductTable)
            ->distinct()
            ->orderBy('id_category')
            ->pluck('id_category')
            ->map(fn (mixed $value): string => (string) $value)
            ->filter(fn (string $value): bool => $value !== '')
            ->values()
            ->all();

        $options = [];

        foreach ($categoryIds as $categoryId) {
            $options[$categoryId] = $categoryId;
        }

        return $options;
    }
}
