<?php

use App\Models\Tenant;
use App\Models\User;
use Filament\Panel;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows a user to belong to multiple tenants', function (): void {
    $tenantA = Tenant::factory()->create();
    $tenantB = Tenant::factory()->create();
    $user = User::factory()->create();

    $user->tenants()->attach($tenantA->id, ['role' => 'owner', 'status' => 'active']);
    $user->tenants()->attach($tenantB->id, ['role' => 'member', 'status' => 'active']);

    expect($user->tenants()->count())->toBe(2)
        ->and($user->canAccessTenant($tenantA))->toBeTrue()
        ->and($user->canAccessTenant($tenantB))->toBeTrue();
});

it('returns only active memberships in getTenants', function (): void {
    $tenantA = Tenant::factory()->create();
    $tenantB = Tenant::factory()->create();
    $user = User::factory()->create();

    $user->tenants()->attach($tenantA->id, ['role' => 'member', 'status' => 'active']);
    $user->tenants()->attach($tenantB->id, ['role' => 'member', 'status' => 'invited']);

    $appPanel = mock(Panel::class);
    $appPanel->shouldReceive('getId')->andReturn('app');

    expect($user->getTenants($appPanel)->pluck('id')->all())->toBe([$tenantA->id]);
});
