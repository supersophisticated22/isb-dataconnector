# Revisions (WordPress-Style)

## Purpose
The `revisions` table is the immutable history of entity changes.  
Each row represents one revision of one entity state transition.

This is used for:
- auditability (`who changed what and when`)
- rollback support
- debugging write behavior across Filament, API, and jobs

## Table Fields
- `id` (PK)
- `tenant_id` (FK -> `tenants.id`)
- `actor_user_id` (nullable FK -> `users.id`)
- `entity_type` (`ps_product`, `ps_specific_price`, `ps_stock_available`, `ps_cms`, `ps_category`, ...)
- `entity_id` (string)
- `action` (`update`, `create`, `delete`, `rollback`)
- `source` (`filament`, `api`, `job`)
- `reason` (nullable string)
- `before_json` (json)
- `after_json` (json)
- `rollback_of_revision_id` (nullable FK -> `revisions.id`)
- `created_at` (timestamp)

Indexes:
- `tenant_id, created_at`
- `tenant_id, entity_type, entity_id`

## Model
`App\Models\Revision` exposes:
- `tenant()` relation
- `actor()` relation

Important model behavior:
- `$timestamps = false` (only `created_at` exists)
- `before_json` / `after_json` are cast to arrays

## Service API
Use `App\Services\RevisionService` for writes/reads.

### Record a revision
```php
app(\App\Services\RevisionService::class)->recordRevision(
    tenantId: $tenantId,
    actorUserId: $actorUserId, // nullable
    entityType: 'ps_product',
    entityId: (string) $productId,
    action: 'update',
    before: $beforeSnapshot,
    after: $afterSnapshot,
    source: 'filament',
    reason: 'Manual price update',
);
```

### Read a revision (tenant-scoped)
```php
$revision = app(\App\Services\RevisionService::class)->getRevision($revisionId);
```

`getRevision()` is tenant-scoped using request tenant context (`request()->attributes->get('tenant_id')`).

## When to Record a Revision
Record immediately around PrestaShop writes:
- `create`: after insert with empty/small `before_json`
- `update`: before + after snapshots
- `delete`: before snapshot and minimal/empty after snapshot
- `rollback`: store new resulting state and set `rollback_of_revision_id`

Preferred order for write flows:
1. Load current entity state (`before`)
2. Execute PrestaShop write transaction
3. Load resulting entity state (`after`)
4. Call `recordRevision(...)`

## Snapshot Guidance
Keep snapshots consistent and minimal:
- include only fields relevant to business behavior
- normalize numeric/string types where practical
- avoid transient/computed-only fields unless needed for debugging

## Notes for New Contributors
- Always pass the resolved `tenant_id` from current request/token context.
- `entity_id` is string by design; cast numeric PrestaShop IDs to string.
- Use `source` values consistently (`filament`, `api`, `job`) for filtering and forensics.
- Do not update existing revision rows; append new rows only.
