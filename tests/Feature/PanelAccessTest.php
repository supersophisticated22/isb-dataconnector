<?php

use App\Models\Tenant;
use App\Models\User;
use Filament\Panel;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows only platform admins to access the admin panel according to panel access rules', function (): void {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $adminPanel = mock(Panel::class);
    $adminPanel->shouldReceive('getId')->andReturn('admin');

    expect($admin->canAccessPanel($adminPanel))->toBeTrue()
        ->and($user->canAccessPanel($adminPanel))->toBeFalse();
});

it('allows tenant users with active memberships to access the app panel', function (): void {
    $tenant = Tenant::factory()->create();
    $tenantUser = User::factory()->create();
    $tenantUser->tenants()->attach($tenant->id, [
        'role' => 'member',
        'status' => 'active',
    ]);

    $appPanel = mock(Panel::class);
    $appPanel->shouldReceive('getId')->andReturn('app');

    expect($tenantUser->canAccessPanel($appPanel))->toBeTrue();
});

it('does not allow tenant-linked admin-role users to access admin panel', function (): void {
    $tenant = Tenant::factory()->create();
    $tenantAdmin = User::factory()->create([
        'role' => 'admin',
    ]);
    $tenantAdmin->tenants()->attach($tenant->id, [
        'role' => 'admin',
        'status' => 'active',
    ]);

    $adminPanel = mock(Panel::class);
    $adminPanel->shouldReceive('getId')->andReturn('admin');

    expect($tenantAdmin->canAccessPanel($adminPanel))->toBeFalse();
});
