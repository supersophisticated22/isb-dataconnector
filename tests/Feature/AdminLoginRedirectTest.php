<?php

use App\Filament\Auth\AdminLogin;
use App\Models\Tenant;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    Filament::setCurrentPanel('admin');
});

it('keeps admin-capable users on admin panel login flow', function (): void {
    $admin = User::factory()->create([
        'role' => 'admin',
        'password' => bcrypt('password'),
    ]);

    Livewire::test(AdminLogin::class)
        ->set('data.email', $admin->email)
        ->set('data.password', 'password')
        ->set('data.remember', false)
        ->call('authenticate')
        ->assertRedirect(route('filament.admin.pages.dashboard'));

    assertAuthenticatedAs($admin, 'web');
    assertGuest('tenant');
});

it('redirects tenant-only users from admin login to app panel entrypoint', function (): void {
    $tenant = Tenant::factory()->create();
    $tenantUser = User::factory()->create([
        'role' => 'user',
        'password' => bcrypt('password'),
    ]);

    $tenantUser->tenants()->attach($tenant->id, [
        'role' => 'member',
        'status' => 'active',
    ]);

    Livewire::test(AdminLogin::class)
        ->set('data.email', $tenantUser->email)
        ->set('data.password', 'password')
        ->set('data.remember', false)
        ->call('authenticate')
        ->assertRedirect(route('filament.app.tenant'));

    assertAuthenticatedAs($tenantUser, 'tenant');
});

it('shows login failure errors for invalid credentials', function (): void {
    $user = User::factory()->create([
        'role' => 'admin',
        'password' => bcrypt('password'),
    ]);

    Livewire::test(AdminLogin::class)
        ->set('data.email', $user->email)
        ->set('data.password', 'invalid-password')
        ->set('data.remember', false)
        ->call('authenticate')
        ->assertHasErrors(['data.email']);

    assertGuest('web');
    assertGuest('tenant');
});
