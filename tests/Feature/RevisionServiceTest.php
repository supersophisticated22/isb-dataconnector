<?php

use App\Models\Tenant;
use App\Models\User;
use App\Services\RevisionService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('records a revision with expected payloads', function () {
    $tenant = Tenant::factory()->create();
    $actor = User::factory()->create([
        'tenant_id' => $tenant->id,
    ]);

    $revision = app(RevisionService::class)->recordRevision(
        tenantId: $tenant->id,
        actorUserId: $actor->id,
        entityType: 'ps_product',
        entityId: '12',
        action: 'update',
        before: ['name' => 'Old Name'],
        after: ['name' => 'New Name'],
        source: 'filament',
        reason: 'Manual edit',
    );

    expect($revision->tenant_id)->toBe($tenant->id)
        ->and($revision->actor_user_id)->toBe($actor->id)
        ->and($revision->entity_type)->toBe('ps_product')
        ->and($revision->entity_id)->toBe('12')
        ->and($revision->action)->toBe('update')
        ->and($revision->source)->toBe('filament')
        ->and($revision->reason)->toBe('Manual edit')
        ->and($revision->before_json)->toBe(['name' => 'Old Name'])
        ->and($revision->after_json)->toBe(['name' => 'New Name']);
});

it('scopes revision lookup by tenant context', function () {
    $tenantA = Tenant::factory()->create();
    $tenantB = Tenant::factory()->create();
    $actor = User::factory()->create([
        'tenant_id' => $tenantA->id,
    ]);

    $service = app(RevisionService::class);

    $revision = $service->recordRevision(
        tenantId: $tenantA->id,
        actorUserId: $actor->id,
        entityType: 'ps_product',
        entityId: '88',
        action: 'rollback',
        before: ['name' => 'Before'],
        after: ['name' => 'After'],
        source: 'api',
        reason: null,
    );

    request()->attributes->set('tenant_id', $tenantA->id);
    expect($service->getRevision($revision->id)?->id)->toBe($revision->id);

    request()->attributes->set('tenant_id', $tenantB->id);
    expect($service->getRevision($revision->id))->toBeNull();
});
