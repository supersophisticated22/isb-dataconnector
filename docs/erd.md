# ERD (SaaS Data Model)

## Overview
This ERD covers the **SaaS application database** (not the PrestaShop tenant DB).
PrestaShop tables remain the source of truth for catalog data and are accessed via dynamic connections.

## Entities (SaaS DB)

### tenants
- id (PK)
- name
- slug (optional)
- db_host
- db_port
- db_name
- db_user
- db_password_encrypted
- db_prefix
- base_shop_url
- status (active/suspended)
- created_at, updated_at

### users
- id (PK)
- tenant_id (FK -> tenants.id) OR nullable if global admin
- name
- email (unique per tenant or global, decide)
- password_hash
- role (admin/editor/viewer)
- created_at, updated_at

### api_tokens
- id (PK)
- tenant_id (FK)
- name
- token_hash
- abilities/scopes (json)
- last_used_at
- created_at, updated_at

### jobs
Tracks long-running queued operations (bulk pricing, reindex, etc.)
- id (PK)
- tenant_id (FK)
- type (bulk_price_update, reindex, etc.)
- status (queued/running/succeeded/failed/cancelled)
- progress_current (int)
- progress_total (int)
- summary (text/json)
- error_message (text)
- started_at, finished_at
- created_by_user_id (FK -> users.id)
- created_at, updated_at

### audit_logs (recommended)
Immutable log for critical operations
- id (PK)
- tenant_id (FK)
- actor_user_id (FK -> users.id, nullable)
- action (string)
- entity_type (string)
- entity_id (string)
- payload (json)
- created_at

### revisions
Immutable entity revision history (WordPress-style, one entity change per row)
- id (PK)
- tenant_id (FK)
- actor_user_id (FK -> users.id, nullable)
- entity_type (string)
- entity_id (string)
- action (update/create/delete/rollback)
- source (filament/api/job)
- reason (nullable string)
- before_json (json)
- after_json (json)
- rollback_of_revision_id (nullable FK -> revisions.id)
- created_at

### tenant_settings (optional if not in tenants)
Only if you prefer a flexible settings table
- id (PK)
- tenant_id (FK)
- key
- value (json/text)
- created_at, updated_at

---

## Relationships
- tenants 1—N users
- tenants 1—N api_tokens
- tenants 1—N jobs
- users 1—N jobs (created_by_user_id)
- tenants 1—N audit_logs
- users 1—N audit_logs (actor_user_id)
- tenants 1—N revisions
- users 1—N revisions (actor_user_id)
- revisions 1—N revisions (rollback_of_revision_id)

---

## Mermaid ER Diagram

```mermaid
erDiagram
  TENANTS ||--o{ USERS : has
  TENANTS ||--o{ API_TOKENS : has
  TENANTS ||--o{ JOBS : runs
  USERS ||--o{ JOBS : created
  TENANTS ||--o{ AUDIT_LOGS : records
  USERS ||--o{ AUDIT_LOGS : performs
  TENANTS ||--o{ REVISIONS : stores
  USERS ||--o{ REVISIONS : performs
  REVISIONS ||--o{ REVISIONS : rolls_back

  TENANTS {
    int id PK
    string name
    string slug
    string db_host
    int db_port
    string db_name
    string db_user
    string db_password_encrypted
    string db_prefix
    string base_shop_url
    string status
    datetime created_at
    datetime updated_at
  }

  USERS {
    int id PK
    int tenant_id FK
    string name
    string email
    string password_hash
    string role
    datetime created_at
    datetime updated_at
  }

  API_TOKENS {
    int id PK
    int tenant_id FK
    string name
    string token_hash
    string abilities_json
    datetime last_used_at
    datetime created_at
    datetime updated_at
  }

  JOBS {
    int id PK
    int tenant_id FK
    int created_by_user_id FK
    string type
    string status
    int progress_current
    int progress_total
    text summary
    text error_message
    datetime started_at
    datetime finished_at
    datetime created_at
    datetime updated_at
  }

  AUDIT_LOGS {
    int id PK
    int tenant_id FK
    int actor_user_id FK
    string action
    string entity_type
    string entity_id
    text payload_json
    datetime created_at
  }

  REVISIONS {
    int id PK
    int tenant_id FK
    int actor_user_id FK
    string entity_type
    string entity_id
    string action
    string source
    string reason
    text before_json
    text after_json
    int rollback_of_revision_id FK
    datetime created_at
  }
