<?php

use App\Filament\Resources\ApiTokens\ApiTokenResource;
use App\Filament\Resources\ApiTokens\Pages\CreateApiToken;
use App\Filament\Resources\ApiTokens\Pages\ListApiTokens;
use App\Models\ApiToken;
use App\Models\Tenant;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\Testing\TestAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    Filament::setCurrentPanel('admin');
});

it('authorizes api token resource actions using admin panel gate', function (): void {
    $platformAdmin = User::factory()->create(['role' => 'admin']);

    $tenant = Tenant::factory()->create();
    $tenantAdmin = User::factory()->create(['role' => 'admin']);
    $tenantAdmin->tenants()->attach($tenant->id, [
        'role' => 'admin',
        'status' => 'active',
    ]);

    $regularUser = User::factory()->create(['role' => 'user']);

    actingAs($platformAdmin);
    expect(ApiTokenResource::canViewAny())->toBeTrue()
        ->and(ApiTokenResource::canCreate())->toBeTrue()
        ->and(ApiTokenResource::canDelete(ApiToken::query()->make()))->toBeTrue();

    actingAs($tenantAdmin);
    expect(ApiTokenResource::canViewAny())->toBeFalse()
        ->and(ApiTokenResource::canCreate())->toBeFalse()
        ->and(ApiTokenResource::canDelete(ApiToken::query()->make()))->toBeFalse();

    actingAs($regularUser);
    expect(ApiTokenResource::canViewAny())->toBeFalse()
        ->and(ApiTokenResource::canCreate())->toBeFalse()
        ->and(ApiTokenResource::canDelete(ApiToken::query()->make()))->toBeFalse();
});

it('creates an api token and stores only hashed token data', function (): void {
    $admin = User::factory()->create(['role' => 'admin']);
    $tenant = Tenant::factory()->create();

    actingAs($admin);

    $component = Livewire::test(CreateApiToken::class)
        ->fillForm([
            'tenant_id' => $tenant->id,
            'name' => 'Customer API Token',
            'abilities' => ['products:read', 'orders:write'],
        ])
        ->call('create')
        ->assertHasNoFormErrors()
        ->assertNotified('API token created');

    $plainTextToken = $component->get('generatedPlainTextToken');

    expect($plainTextToken)->toBeString()
        ->and(strlen($plainTextToken))->toBe(64);

    $createdToken = ApiToken::query()->firstOrFail();

    expect($createdToken->tenant_id)->toBe($tenant->id)
        ->and($createdToken->name)->toBe('Customer API Token')
        ->and($createdToken->abilities)->toBe(['products:read', 'orders:write'])
        ->and(strlen($createdToken->token_hash))->toBe(64)
        ->and($createdToken->token_hash)->toBe(hash('sha256', $plainTextToken));
});

it('deletes an api token from the list table action', function (): void {
    $admin = User::factory()->create(['role' => 'admin']);
    $tenant = Tenant::factory()->create();

    ApiToken::issue($tenant->id, 'Keep Token');
    [$tokenToDelete] = ApiToken::issue($tenant->id, 'Delete Token');

    actingAs($admin);

    Livewire::test(ListApiTokens::class)
        ->assertCanSeeTableRecords(ApiToken::query()->get())
        ->callAction(TestAction::make(DeleteAction::class)->table($tokenToDelete))
        ->assertNotified();

    expect(ApiToken::query()->whereKey($tokenToDelete->id)->exists())->toBeFalse();
});
