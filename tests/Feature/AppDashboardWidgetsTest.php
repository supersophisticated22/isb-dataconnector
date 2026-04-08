<?php

use App\Filament\App\Widgets\ProductOverviewStats;
use App\Filament\App\Widgets\RecentProductsTable;
use App\Models\Tenant;
use App\Providers\Filament\AppPanelProvider;
use App\Services\TenantContext;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config()->set('database.connections.tenant_ps', [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
        'foreign_key_constraints' => false,
    ]);

    Filament::setCurrentPanel('app');
});

it('registers app dashboard custom widgets and removes filament defaults', function (): void {
    $panel = (new AppPanelProvider(app()))->panel(Panel::make());
    $widgets = $panel->getWidgets();

    expect($widgets)
        ->toContain(ProductOverviewStats::class)
        ->toContain(RecentProductsTable::class);

    expect(in_array(AccountWidget::class, $widgets, true))->toBeFalse()
        ->and(in_array(FilamentInfoWidget::class, $widgets, true))->toBeFalse();
});

it('calculates product overview stats using tenant scoped products', function (): void {
    $tenant = Tenant::factory()->create();
    Filament::setTenant($tenant, isQuiet: true);
    app(TenantContext::class)->setTenant($tenant);

    registerProductSqliteFunction();
    createProductTables();

    seedProduct(101, 'Active In Stock', active: true, stockQty: 8, price: 12.5);
    seedProduct(102, 'Inactive Out Of Stock', active: false, stockQty: 0, price: 15.0);
    seedProduct(103, 'Active Out Of Stock', active: true, stockQty: -2, price: 22.0);

    $widget = new class extends ProductOverviewStats
    {
        /**
         * @return array<Stat>
         */
        public function exposedStats(): array
        {
            return $this->getStats();
        }
    };

    $stats = collect($widget->exposedStats())
        ->mapWithKeys(fn (Stat $stat): array => [(string) $stat->getLabel() => (int) $stat->getValue()])
        ->all();

    expect($stats)->toBe([
        'Total' => 3,
        'Active' => 2,
        'Out of stock' => 2,
    ]);
});

it('renders recent products table widget with tenant scoped records', function (): void {
    $tenant = Tenant::factory()->create();
    Filament::setTenant($tenant, isQuiet: true);
    app(TenantContext::class)->setTenant($tenant);

    registerProductSqliteFunction();
    createProductTables();

    seedProduct(10, 'Older Product', active: true, stockQty: 5, price: 7.5);
    seedProduct(20, 'Newest Product', active: true, stockQty: 3, price: 9.9);

    Livewire::test(RecentProductsTable::class)
        ->assertSee('Newest Product')
        ->assertSee('Older Product');
});

function registerProductSqliteFunction(): void
{
    $pdo = DB::connection('tenant_ps')->getPdo();

    $pdo->sqliteCreateFunction('GREATEST', fn (mixed ...$values): mixed => max($values));
}

function createProductTables(): void
{
    Schema::connection('tenant_ps')->create('ps_product', function (Blueprint $table): void {
        $table->integer('id_product')->primary();
        $table->integer('id_manufacturer')->default(0);
        $table->string('reference')->nullable();
        $table->boolean('active')->default(true);
        $table->decimal('price', 20, 6)->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_product_lang', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_lang')->default(1);
        $table->string('name')->nullable();
        $table->text('description')->nullable();
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->string('meta_keywords')->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_manufacturer', function (Blueprint $table): void {
        $table->integer('id_manufacturer')->primary();
        $table->string('name')->nullable();
    });

    Schema::connection('tenant_ps')->create('ps_stock_available', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_product_attribute')->default(0);
        $table->integer('quantity')->default(0);
    });

    Schema::connection('tenant_ps')->create('ps_specific_price', function (Blueprint $table): void {
        $table->integer('id_product');
        $table->integer('id_product_attribute')->default(0);
        $table->string('reduction_type')->nullable();
        $table->decimal('reduction', 20, 6)->default(0);
        $table->string('from')->default('0000-00-00 00:00:00');
        $table->string('to')->default('0000-00-00 00:00:00');
    });
}

function seedProduct(int $productId, string $name, bool $active, int $stockQty, float $price): void
{
    DB::connection('tenant_ps')->table('ps_product')->insert([
        'id_product' => $productId,
        'id_manufacturer' => 0,
        'reference' => 'SKU-'.$productId,
        'active' => $active ? 1 : 0,
        'price' => $price,
    ]);

    DB::connection('tenant_ps')->table('ps_product_lang')->insert([
        'id_product' => $productId,
        'id_lang' => 1,
        'name' => $name,
        'description' => 'Description for '.$name,
        'meta_title' => $name,
        'meta_description' => $name.' description',
        'meta_keywords' => 'keyword',
    ]);

    DB::connection('tenant_ps')->table('ps_stock_available')->insert([
        'id_product' => $productId,
        'id_product_attribute' => 0,
        'quantity' => $stockQty,
    ]);
}
