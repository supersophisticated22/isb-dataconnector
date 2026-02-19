# Project Context — PrestaShop 8.2 Fast Admin (FilamentPHP v5 SaaS)

## One-liner
A multi-tenant SaaS built with Laravel + FilamentPHP v5 that connects directly to a customer’s PrestaShop 8.2 MariaDB database to provide a fast admin UI for products, pricing (incl. specific prices), stock, categories, and CMS pages—plus per-tenant TypeSense search and a secured product API (active products only). Optionally, a lightweight PrestaShop module can be installed to support cache clearing, canonical URLs, and image uploads.

---

# Target Environment
[rules.md](../../surant-360/docs/rules.md)
[erd.md](../../surant-360/docs/erd.md)
[notifications.md](../../surant-360/docs/notifications.md)
[architecture-overview.md](../../surant-360/docs/architecture-overview.md)
- PrestaShop: 8.2
- Database: MariaDB
- Multishop: ❌ No
- Multilanguage: ❌ No (single language)
- Stock management: Simple quantity
- Products: Simple only (no combinations in V1)
- Hosting: We manage hosting, so remote DB access is guaranteed.

---

# SaaS / Multi-tenant Architecture

## Tenant model
Each tenant represents one customer store.

Tenant provides:
- DB host / port / database / username / password
- Table prefix (commonly `ps_`, configurable)

System behavior:
- Dynamically creates a DB connection per tenant at runtime.
- Credentials encrypted at rest.
- Assume PrestaShop 8.2 schema (no strict schema validation at connect).
- No cross-tenant data access.

---

# Store Base URL (Webshop URL) Strategy

We need a reliable base URL to build product links and image links.

Approach:
- On tenant onboarding (and on demand), read shop URL config from PrestaShop DB:
    - `{prefix}shop` and `{prefix}shop_url` (common PS tables)
- Sync resolved base URL into SaaS tenant settings (`tenant.base_shop_url`).

Rules:
- Single-shop => pick main shop URL.
- Prefer HTTPS if available.
- Allow manual override in SaaS settings.
- Provide “Resync shop URL” action.

---

# Core Scope (V1)

## 1) Products
Manage:
- Name
- Active
- Reference (SKU)
- Manufacturer
- Default category
- Basic SEO fields (optional)

Typical tables:
- {prefix}product
- {prefix}product_lang
- {prefix}product_shop
- {prefix}manufacturer
- {prefix}category_product

Notes:
- Single language simplifies *_lang updates.
- No multishop simplifies scoping (product_shop may still exist but is single-context).

---

## 2) Pricing (Base + Specific Prices)
Manage:
- Base price (“original price”)
- Specific prices to compute “current price”

Tables:
- {prefix}product
- {prefix}specific_price

Pricing semantics (UI + API):
- `original_price_tax_excl`
- `current_price_tax_excl`
- `original_price_tax_incl`
- `current_price_tax_incl`
- discount info:
    - `discount_amount_tax_excl`
    - `discount_percent`

Meaning:
- “Original price X, now costs Y” is supported everywhere.

Tax handling:
- PrestaShop stores base prices tax excl.
- For API we expose both tax excl and tax incl.
- Tax incl is derived by applying the product’s tax rules (implementation details below).

Specific price evaluation:
- “current price” = best applicable specific price *right now* (date-valid) for the default context we support.
- If no applicable specific price exists => current == original.

---

## 3) Stock
Manage:
- Quantity (simple)
  Tables:
- {prefix}stock_available

---

## 4) Categories
Manage:
- Name, Active, Parent, (Position optional)
  Tables:
- {prefix}category
- {prefix}category_lang
- {prefix}category_product

Important:
- Category tree uses nested set (`nleft` / `nright`).
- Parent changes must preserve tree integrity.

---

## 5) CMS Pages
Manage:
- Title, Content, Meta fields (optional), Active
  Tables:
- {prefix}cms
- {prefix}cms_lang

---

# Filament Structure

Resources:
- ProductResource
- CategoryResource
- CmsPageResource

Supporting (optional / read-only):
- ManufacturerResource

Design principles:
- Avoid N+1 queries
- Lightweight indexes
- Searchable selects for large relationships
- Load heavy details only on detail/edit

---

# TypeSense Search (Per Tenant)

Goal:
Fast product search for admin UI and to power the customer API.

Isolation:
- Recommended: separate collection per tenant
    - `products__{tenant_id}`

Indexed fields (minimum):
- id
- name
- reference
- active
- manufacturer_name
- category_ids
- original_price_tax_excl
- current_price_tax_excl
- original_price_tax_incl
- current_price_tax_incl
- discount_amount_tax_excl
- discount_percent
- product_url
- image_url
- updated_at

Index update strategy:
- Normal edits: update TypeSense after DB commit.
- Bulk operations: update TypeSense within each queued chunk job.
- Provide “Reindex tenant” (queued).

---

# Secured Customer API (Products)

Purpose:
Customer queries their own products via secure API.

Constraints:
- Only **active products**
- Cover image only
- URL is id-based in V1

Auth:
- Tenant API keys (default)
- Rate limiting per tenant key

Endpoints (suggested):
- `GET /api/v1/products`
    - filters: q, category, manufacturer, min_price, max_price, has_discount, updated_since
    - pagination: page, per_page
- `GET /api/v1/products/{id}`
- `GET /api/v1/products/search` (optional; proxy TypeSense)

Data returned:
- id
- name
- reference
- manufacturer
- original_price_tax_excl
- current_price_tax_excl
- original_price_tax_incl
- current_price_tax_incl
- discount_amount_tax_excl
- discount_percent
- product_url (V1 stable link: id-based)
- image_url (cover only)

Serving strategy:
- List/search via TypeSense.
- Single product can be TypeSense-first with DB fallback if needed.

---

# URL & Image Rules (V1)

## Product URL
V1 uses a stable id-based URL:
- `{base_shop_url}/index.php?id_product={id}&controller=product`

Canonical URLs (rewrite-based) are planned via optional PrestaShop module.

## Cover Image URL
Return cover image only.
- Initial strategy: compute image URL using PrestaShop’s image conventions and DB data
- Optional module can provide guaranteed correct image URL generation.

---

# Bulk Pricing Updates (V2) — Queued Jobs

Goal:
Bulk price updates by filters:
- manufacturer
- category
- price range
- has_discount, etc.

Requirements:
- queued jobs
- chunked processing
- logged progress/outcomes
- preview (recommended)

Flow:
1) Define rule
2) Resolve impacted set (TypeSense or DB)
3) Enqueue jobs in chunks
4) Each chunk:
    - transactionally applies updates
    - recomputes current pricing fields
    - updates TypeSense docs

---

# Optional PrestaShop Module (“Bridge Module”)

Because direct DB writes bypass hooks/modules, an optional module can provide:

1) Cache / index helpers
- Clear relevant caches after price updates (where applicable)
- Trigger search index rebuild or refresh (if store uses it)

2) Canonical URL resolution
- Return canonical product URL for a product id (rewrite-aware)

3) Image upload support
- Provide an authenticated endpoint to upload a product image
- Store it via PrestaShop’s native mechanisms so it appears correctly everywhere

Design:
- Module exposes a small secured API (token-based) callable only by our SaaS
- Tenant stores module endpoint + token in SaaS settings
- Module is optional: SaaS should function without it in V1, but gets more correctness with it

---

# Data Integrity & Transactions

- Use DB transactions for multi-table writes.
- Keep base price + specific prices consistent.
- Log all admin writes and bulk job results.

---

# Out of Scope (for now)

- Orders, Customers
- Multishop/multilanguage logic
- Combinations/variants (V1)
- Advanced stock management

---

# Pricing Engine Rules (NL VAT Simplified)

All tenant shops operate in the Netherlands.

Tax assumptions:
- VAT rates are simple and limited to:
    - 21% (standard)
    - 9% (reduced)

Therefore, the SaaS will compute tax-inclusive pricing internally without requiring full PrestaShop tax engine complexity.

## Tax-inclusive calculation

For any price:

- `price_tax_incl = price_tax_excl * (1 + vat_rate)`

Example:
- €100 excl with 21% VAT → €121 incl
- €100 excl with 9% VAT → €109 incl

VAT rate is determined per product via its tax rule group:

Tables involved:
- {prefix}tax_rules_group
- {prefix}tax_rule
- {prefix}tax

Implementation simplification:
- Only NL tax context is supported in V1.
- No country switching, no complex multi-rate logic.

---

## Current Price Computation (Specific Prices)

The API and admin UI expose:

- `original_price_tax_excl`
- `current_price_tax_excl`
- `original_price_tax_incl`
- `current_price_tax_incl`
- discount metadata

### Rule:

1. Start with base price from `{prefix}product.price`
   → original price

2. Check for active specific prices in `{prefix}specific_price`

Specific price applies if:
- product matches
- current date is within `from` / `to`
- reduction is defined

3. Compute best applicable discount:

- Percent reduction:
    - `current = original * (1 - reduction)`
- Fixed reduction:
    - `current = original - reduction_amount`
- Fixed override price:
    - `current = fixed_price`

4. Discount metadata:

- `discount_amount = original - current`
- `discount_percent = discount_amount / original`

### Supported scope (V1):

- Product-level specific prices only
- Date-valid discounts only
- No customer-group / currency / country constraints yet

More complex PrestaShop pricing rules are deferred to later versions.

---
