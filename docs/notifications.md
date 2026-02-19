# Notifications

## Purpose
Define what the system notifies about, who receives notifications, and through which channels.

## Channels (V1)
- **In-app only**
    - Filament notifications/toasts
    - Optional: notification center page

No email notifications in V1.

---

## Core Notification Types

### 1) Tenant Onboarding
- **DB connection successful**
    - Recipient: initiating user / tenant admins
    - Channel: in-app
- **DB connection failed**
    - Recipient: initiating user / tenant admins
    - Channel: in-app
    - Include sanitized error details (no credentials)

### 2) Background Jobs (Queued)
Applies to:
- Reindex tenant
- Bulk price update (V2)
- Large imports (future)

Events:
- Job started
- Job succeeded (summary)
- Job failed (error)

Recipients:
- The user who initiated the job
- Tenant admins (optional)

Channel:
- in-app only

### 3) Security / Access
- API token created/rotated/revoked
    - Recipient: tenant admins
    - Channel: in-app
- Excessive API rate limiting triggered
    - Recipient: tenant admins
    - Channel: in-app

### 4) Data Integrity / Sync Alerts
- TypeSense indexing error (recommended)
    - Trigger: repeated failures or reindex required
    - Recipient: tenant admins
    - Channel: in-app

---

## Notification Payload Guidelines
- Never include:
    - DB password
    - raw credentials
    - stack traces in user-facing messages
- Include:
    - operation name
    - timestamp
    - job id (internal)
    - human-friendly summary
    - link to relevant Filament page (job detail/log)

---

## UX Requirements
- All notification text must be translatable (EN + NL)
- Severity levels:
    - info / success / warning / danger
