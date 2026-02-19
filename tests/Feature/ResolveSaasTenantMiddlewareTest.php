<?php

use App\Models\ApiToken;
use App\Models\Tenant;
use App\Services\TenantContext;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    Route::middleware('api')->get('/api/testing/tenant-context', function (TenantContext $tenantContext) {
        return response()->json([
            'tenant_id' => $tenantContext->tenantId(),
            'tenant_name' => $tenantContext->getTenant()?->name,
        ]);
    });
});

it('sets tenant context when token is valid', function () {
    $tenant = Tenant::factory()->create();
    [, $plainTextToken] = ApiToken::issue($tenant->id, 'Test Token');

    $response = getJson('/api/testing/tenant-context', [
        'Authorization' => 'Bearer '.$plainTextToken,
    ]);

    $response->assertSuccessful()
        ->assertJsonPath('tenant_id', $tenant->id)
        ->assertJsonPath('tenant_name', $tenant->name);
});

it('returns 401 when token is invalid', function () {
    $response = getJson('/api/testing/tenant-context', [
        'Authorization' => 'Bearer invalid-token',
    ]);

    $response->assertUnauthorized()
        ->assertJsonPath('message', __('saas.auth.invalid_tenant_token'));
});

it('returns 401 when token is missing for api requests', function () {
    $response = getJson('/api/testing/tenant-context');

    $response->assertUnauthorized()
        ->assertJsonPath('message', __('saas.auth.missing_tenant_token'));
});
