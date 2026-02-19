<?php

namespace App\Services;

use App\Models\Revision;
use RuntimeException;

class RevisionService
{
    public function __construct(private TenantContext $tenantContext) {}

    /**
     * @param  array<string, mixed>|null  $before
     * @param  array<string, mixed>|null  $after
     */
    public function recordRevision(
        int $tenantId,
        ?int $actorUserId,
        ?int $actorTenantUserId,
        string $entityType,
        string $entityId,
        string $action,
        ?array $before,
        ?array $after,
        string $source,
        ?string $reason = null,
    ): Revision {
        return Revision::query()->create([
            'tenant_id' => $tenantId,
            'actor_user_id' => $actorUserId,
            'actor_tenant_user_id' => $actorTenantUserId,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'action' => $action,
            'source' => $source,
            'reason' => $reason,
            'before_json' => $before ?? [],
            'after_json' => $after ?? [],
        ]);
    }

    public function getRevision(int $id): ?Revision
    {
        return Revision::query()
            ->whereKey($id)
            ->where('tenant_id', $this->resolveTenantId())
            ->first();
    }

    private function resolveTenantId(): int
    {
        $tenantId = $this->tenantContext->tenantId();

        if (! is_int($tenantId) || $tenantId < 1) {
            throw new RuntimeException('Tenant context is missing.');
        }

        return $tenantId;
    }
}
