<?php

use App\Filament\App\Resources\BlogCategories\BlogCategoryResource;
use App\Filament\App\Resources\BlogPosts\BlogPostResource;
use App\Filament\App\Resources\BlogReplies\BlogReplyResource;
use App\Models\Tenant;
use App\Models\TenantPrestaShopProduct;
use App\Models\User;
use App\Services\TenantContext;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config()->set('database.connections.tenant_ps', [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
        'foreign_key_constraints' => false,
    ]);

    DB::purge('tenant_ps');
    DB::reconnect('tenant_ps');

    Schema::connection('tenant_ps')->create('ps_lang', function (Blueprint $table): void {
        $table->integer('id_lang')->primary();
    });

    DB::connection('tenant_ps')->table('ps_lang')->insert([
        ['id_lang' => 1],
    ]);
});

it('fails closed when tenant context is missing for blog resources', function (): void {
    app(TenantContext::class)->clear();

    expect(strtolower(BlogCategoryResource::getEloquentQuery()->toSql()))->toContain('1 = 0')
        ->and(strtolower(BlogPostResource::getEloquentQuery()->toSql()))->toContain('1 = 0')
        ->and(strtolower(BlogReplyResource::getEloquentQuery()->toSql()))->toContain('1 = 0');
});

it('allows tenant admin to view blog resources via tenant guard gate', function (): void {
    $tenant = Tenant::factory()->create();
    $user = User::factory()->create();
    $user->tenants()->attach($tenant->id, ['role' => 'admin', 'status' => 'active']);

    app(TenantContext::class)->setTenant($tenant);
    actingAs($user, 'tenant');

    expect(BlogCategoryResource::canViewAny())->toBeTrue()
        ->and(BlogPostResource::canViewAny())->toBeTrue()
        ->and(BlogReplyResource::canViewAny())->toBeTrue()
        ->and(BlogCategoryResource::canEdit(TenantPrestaShopProduct::query()->make()))->toBeTrue()
        ->and(BlogPostResource::canEdit(TenantPrestaShopProduct::query()->make()))->toBeTrue()
        ->and(BlogReplyResource::canEdit(TenantPrestaShopProduct::query()->make()))->toBeTrue();
});

it('builds a lean select for blog post index query', function (): void {
    $tenant = Tenant::factory()->create();
    app(TenantContext::class)->setTenant($tenant);

    $columns = BlogPostResource::getEloquentQuery()->getQuery()->columns;

    expect($columns)->toBe([
        'p.id_post',
        'p.id_post as id_product',
        'p.enabled',
        'p.sort_order',
        'pl.title',
        'cl.title as category_title',
    ]);
});
