<?php

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows only platform admins to impersonate users', function (): void {
    $admin = User::factory()->create(['role' => 'admin']);
    $member = User::factory()->create(['role' => 'user']);

    expect($admin->canImpersonate())->toBeTrue()
        ->and($member->canImpersonate())->toBeFalse();
});

it('prevents impersonating platform admins', function (): void {
    $tenant = Tenant::factory()->create();

    $targetAdmin = User::factory()->create(['role' => 'admin']);
    $targetMember = User::factory()->create(['role' => 'user']);
    $targetUnlinkedMember = User::factory()->create(['role' => 'user']);
    $targetMember->tenants()->attach($tenant->id, [
        'role' => 'member',
        'status' => 'active',
    ]);
    $targetAdmin->tenants()->attach($tenant->id, [
        'role' => 'admin',
        'status' => 'active',
    ]);

    expect($targetAdmin->canBeImpersonated())->toBeTrue()
        ->and($targetUnlinkedMember->canBeImpersonated())->toBeFalse()
        ->and($targetMember->canBeImpersonated())->toBeTrue();
});
