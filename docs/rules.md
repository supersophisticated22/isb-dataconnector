# Architecture Overview

## Goal
Build a multi-tenant SaaS (Laravel + FilamentPHP v5) that connects to each tenant’s **own PrestaShop 8.2 MariaDB** database to manage products, pricing (incl. specific prices), stock, categories, and CMS pages. Provide **TypeSense per tenant** for fast search and a **secured API** for customers to query active products.

## Context & Assumptions
- PrestaShop 8.2 + MariaDB
- Single shop, single language in the store DB
- Simple products only in V1 (no combinations/variants)
- NL-only VAT rates: 21% or 9%
- Tenants provide DB credentials; we manage hosting so remote DB connections are allowed
- We assume PS schema compatibility (no strict schema validation at connect time)

---

## Tenant Resolution (Authoritative)
**Tenancy is resolved via API tokens.**

- Every request (admin panel + customer API) must authenticate with a token.
- Token maps to exactly one tenant.
- Tenant context is derived from token → `tenant_id`.

Implications:
- No subdomain/custom-domain routing required for tenancy.
- All multi-tenant isolation is enforced by:
    - selecting tenant DB connection dynamically
    - selecting the tenant TypeSense collection
    - scoping all reads/writes to that tenant

---

## High-level Components

### 1) SaaS App (Laravel)
- **Filament Admin Panel**
    - Manage tenant onboarding (DB credentials, prefix)
    - Manage Products, Categories, CMS
    - Pricing management (base + specific prices)
    - Stock management (simple quantity)
    - Operations: resync shop URL, reindex, bulk pricing jobs (V2)

- **Tenant Runtime**
    - Middleware authenticates token
    - Loads tenant by token → `tenant_id`
    - Builds dynamic DB connection per request (tenant credentials)
    - Applies table prefix logic in all queries

- **Domain Services**
    - ProductService: read/write PS product tables, compute derived fields
    - PricingService: compute original/current prices, discounts, VAT incl/excl
    - StockService: update stock_available
    - CategoryService: manage category tree safely (nested set)
    - CmsService: manage CMS pages

### 2) TypeSense (Search)
- Per-tenant isolation:
    - one collection per tenant: `products__{tenant_id}`
- Document contains:
    - product basics, active, manufacturer, category_ids
    - computed prices (original/current, incl/excl), discount fields
    - product_url (id-based for V1)
    - image_url (cover only)
- Synced:
    - immediately after DB commit for normal edits
    - via queue chunk jobs for bulk updates / reindex

### 3) Customer API
- Secured API (token per tenant)
- Endpoints for querying **active products only**
- List/search served from TypeSense (fast)
- Optional DB fallback for strict freshness if needed

### 4) Optional PrestaShop Bridge Module (Future / Optional)
A lightweight PS module can be installed to:
- clear caches / trigger index refresh
- return canonical URLs
- upload product images via PS-native mechanisms

SaaS should function without this module in V1.

---

## Request Flow (Typical)

### Admin edit product price
1. Request authenticates (token → tenant)
2. SaaS writes to PrestaShop tables in a transaction
3. SaaS recomputes:
    - original/current price tax excl
    - VAT rate (9/21)
    - original/current price tax incl
    - discount amount/percent
4. SaaS updates TypeSense doc for that product
5. In-app notification is shown (success/failure)

### Customer API product search
1. Client calls `/api/v1/products?q=...` with tenant token
2. API queries tenant TypeSense collection
3. Returns normalized product objects (active only)

---

## Data Ownership
- Source of truth for catalog data remains the tenant’s PrestaShop database.
- SaaS stores:
    - tenant connection credentials (encrypted)
    - tenant settings (prefix, base_shop_url)
    - API tokens and scopes
    - job execution and audit logs

---

## Deployment & Ops
- Queue workers required (bulk pricing V2, reindexing)
- Centralized logs + per-tenant job tracking
- Rate limiting for API

---

## Key Design Decisions
- Tenancy: API token
- Notifications: in-app only
- URL in V1: id-based product URL is acceptable
- Image in V1: cover image only
- VAT: compute tax-incl prices internally with NL 9/21%
- TypeSense isolation: separate collection per tenant
- Bulk pricing: queued jobs, chunked updates, progress tracking

