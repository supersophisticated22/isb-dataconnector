<?php

namespace App\Filament\App\Resources\Products;

use App\Filament\App\Resources\Products\Pages\ListProducts;
use App\Filament\App\Resources\Products\Pages\ViewProduct;
use App\Filament\App\Resources\Products\RelationManagers\SpecificPricesRelationManager;
use App\Filament\App\Resources\Products\Schemas\ProductInfolist;
use App\Filament\App\Resources\Products\Tables\ProductsTable;
use App\Models\TenantPrestaShopProduct;
use App\Models\User;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopConnection;
use App\Services\TenantPrestaShopProductQueryBuilder;
use App\Services\TypeSenseClient;
use BackedEnum;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Throwable;

class ProductResource extends Resource
{
    protected static ?string $model = TenantPrestaShopProduct::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 30;

    public static function infolist(Schema $schema): Schema
    {
        return ProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getNavigationLabel(): string
    {
        return __('saas.resources.products.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('saas.resources.products.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('saas.resources.products.plural_model_label');
    }

    public static function canViewAny(): bool
    {
        $user = self::resolveGateUser();

        if (! $user instanceof User) {
            return false;
        }

        return Gate::forUser($user)->allows('view-tenant-products');
    }

    public static function canView(mixed $record): bool
    {
        $user = self::resolveGateUser();

        if (! $user instanceof User) {
            return false;
        }

        return Gate::forUser($user)->allows('view-tenant-products');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(mixed $record): bool
    {
        return false;
    }

    public static function canDelete(mixed $record): bool
    {
        return false;
    }

    /**
     * @return array<int, class-string>
     */
    public static function getRelations(): array
    {
        return [
            SpecificPricesRelationManager::class,
        ];
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'view' => ViewProduct::route('/{record}'),
        ];
    }

    /**
     * @return Builder<\Illuminate\Database\Eloquent\Model>
     */
    public static function getEloquentQuery(): Builder
    {
        if (! self::hasValidTenantContext()) {
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }

        return app(TenantPrestaShopProductQueryBuilder::class)->buildBaseQuery(parent::getEloquentQuery());
    }

    /**
     * @param  Builder<\Illuminate\Database\Eloquent\Model>  $query
     */
    public static function applyTypeSenseSearch(Builder $query, string $search): void
    {
        $search = trim($search);

        if ($search === '') {
            return;
        }

        $productIds = self::resolveTypeSenseProductIds($search);

        if ($productIds === []) {
            $query->whereRaw('1 = 0');

            return;
        }

        $query->whereIn('p.id_product', $productIds);

        $driver = DB::connection('tenant_ps')->getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            $placeholders = implode(',', array_fill(0, count($productIds), '?'));
            $query->orderByRaw("FIELD(p.id_product, {$placeholders})", $productIds);

            return;
        }

        $query->orderByDesc('p.id_product');
    }

    /**
     * @return array<int, string>
     */
    public static function manufacturerFilterOptions(): array
    {
        if (! self::hasValidTenantContext()) {
            return [];
        }

        $manufacturerTable = app(TenantPrestaShopConnection::class)->table('manufacturer');

        try {
            /** @var array<int, string> $options */
            $options = DB::connection('tenant_ps')
                ->table($manufacturerTable)
                ->whereNotNull('name')
                ->orderBy('name')
                ->pluck('name', 'id_manufacturer')
                ->mapWithKeys(fn (mixed $name, mixed $id): array => [(int) $id => (string) $name])
                ->all();
        } catch (Throwable) {
            return [];
        }

        return $options;
    }

    /**
     * @return list<int>
     */
    private static function resolveTypeSenseProductIds(string $query): array
    {
        $tenantId = app(TenantContext::class)->tenantId();

        if (! is_int($tenantId) || $tenantId < 1) {
            return [];
        }

        try {
            $results = app(TypeSenseClient::class)->searchProductDocs(
                tenantId: $tenantId,
                query: $query,
                page: 1,
                perPage: 250,
            );
        } catch (Throwable) {
            return [];
        }

        /** @var list<int> $productIds */
        $productIds = collect($results['data'])
            ->map(fn (mixed $product): int => (int) data_get($product, 'id', 0))
            ->filter(fn (int $id): bool => $id > 0)
            ->unique()
            ->values()
            ->all();

        return $productIds;
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
