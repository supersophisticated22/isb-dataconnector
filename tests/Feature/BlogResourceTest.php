<?php

use App\Filament\App\Resources\BlogCategories\BlogCategoryResource;
use App\Filament\App\Resources\BlogPosts\BlogPostResource;
use App\Filament\App\Resources\BlogReplies\BlogReplyResource;
use App\Models\Tenant;
use App\Models\TenantPrestaShopProduct;
use App\Models\User;
use App\Services\TenantContext;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

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
