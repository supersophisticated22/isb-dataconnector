<?php

use App\Filament\Resources\Tenants\Pages\EditTenant;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Models\Tenant;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    Filament::setCurrentPanel('admin');
});

it('creates a user with selected tenant memberships', function (): void {
    $tenantA = Tenant::factory()->create();
    $tenantB = Tenant::factory()->create();
    $admin = User::factory()->create(['role' => 'admin']);

    actingAs($admin);

    Livewire::test(CreateUser::class)
        ->fillForm([
            'name' => 'Linked User',
            'email' => 'linked-user@example.test',
            'password' => 'password',
            'role' => 'user',
            'tenants' => [$tenantA->id, $tenantB->id],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $user = User::query()->where('email', 'linked-user@example.test')->firstOrFail();

    expect($user->tenants()->pluck('tenants.id')->sort()->values()->all())
        ->toBe([$tenantA->id, $tenantB->id]);
});

it('syncs tenant memberships when editing a user', function (): void {
    $tenantA = Tenant::factory()->create();
    $tenantB = Tenant::factory()->create();
    $tenantC = Tenant::factory()->create();
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create();

    $user->tenants()->attach($tenantA->id);
    $user->tenants()->attach($tenantB->id);

    actingAs($admin);

    Livewire::test(EditUser::class, ['record' => $user->getKey()])
        ->fillForm([
            'tenants' => [$tenantC->id],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($user->fresh()->tenants()->pluck('tenants.id')->all())
        ->toBe([$tenantC->id]);
});

it('attaches existing users from tenant edit page', function (): void {
    $tenant = Tenant::factory()->create();
    $admin = User::factory()->create(['role' => 'admin']);
    $userA = User::factory()->create();
    $userB = User::factory()->create();

    actingAs($admin);

    Livewire::test(EditTenant::class, ['record' => $tenant->getKey()])
        ->fillForm([
            'users' => [$userA->id, $userB->id],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($tenant->fresh()->users()->pluck('users.id')->sort()->values()->all())
        ->toBe([$userA->id, $userB->id]);
});

it('creates a user inline from tenant edit and attaches it', function (): void {
    $tenant = Tenant::factory()->create();
    $admin = User::factory()->create(['role' => 'admin']);

    actingAs($admin);

    Livewire::test(EditTenant::class, ['record' => $tenant->getKey()])
        ->callFormComponentAction('users', 'createOption', data: [
            'name' => 'Inline User',
            'email' => 'inline-user@example.test',
            'password' => 'password',
            'role' => 'user',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $inlineUser = User::query()->where('email', 'inline-user@example.test')->firstOrFail();

    expect($tenant->fresh()->users()->pluck('users.id')->all())
        ->toContain($inlineUser->id);
});

it('uses tenant membership pivot defaults when linking through forms', function (): void {
    $tenant = Tenant::factory()->create();
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create();

    actingAs($admin);

    Livewire::test(EditTenant::class, ['record' => $tenant->getKey()])
        ->fillForm([
            'users' => [$user->id],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $membership = $user->fresh()->tenantMembership($tenant->id);

    expect($membership)
        ->not()->toBeNull()
        ->and($membership['role'])->toBe('member')
        ->and($membership['status'])->toBe('active');
});
