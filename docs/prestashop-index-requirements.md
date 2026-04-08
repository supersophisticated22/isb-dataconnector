# PrestaShop Index Requirements

## Scope

These requirements apply to each tenant PrestaShop database connection (`tenant_ps`).
The schema is external (owned by PrestaShop), so this document defines operational requirements for DBAs/platform teams.

## Minimum indexes required

The following indexes are required for product list/search queries used by the SaaS app.

- `PRIMARY` on `product (id_product)`
- `idx_product_id_manufacturer` on `product (id_manufacturer)`
- `idx_product_active` on `product (active)`
- `idx_product_lang_id_product_id_lang` on `product_lang (id_product, id_lang)`
- `idx_stock_available_id_product_id_product_attribute` on `stock_available (id_product, id_product_attribute)`
- `idx_specific_price_id_product_id_product_attribute` on `specific_price (id_product, id_product_attribute)`
- `idx_specific_price_from` on `specific_price (from)`
- `idx_specific_price_to` on `specific_price (to)`

Notes:
- Index names are a recommended convention. Existing names are acceptable if they cover the same columns.
- Column order matters for composite indexes and should match this document.

## Optional nice-to-have indexes

These are non-blocking but can improve filtering/sorting workloads in larger tenant databases.

- `idx_product_active_id_product` on `product (active, id_product)`
- `idx_product_id_manufacturer_active` on `product (id_manufacturer, active)`
- `idx_stock_available_id_product_attribute_qty` on `stock_available (id_product, id_product_attribute, quantity)`
- `idx_specific_price_product_attribute_from_to` on `specific_price (id_product, id_product_attribute, from, to)`

## Ownership note

We do **not** manage these indexes with Laravel migrations in this repository.
Reason: these tables belong to PrestaShop (external tenant schema), not to the SaaS app schema.

## CMS pages/categories indexes

These indexes are required for the CMSPages/CMSCategories list screens used by Filament.

- `idx_cms_position_id` on `cms (position, id_cms)` for default list sorting.
- `idx_cms_category_position_id` on `cms (id_cms_category, position, id_cms)` for category-filtered lists.
- `idx_cms_category_lang_category_lang` on `cms_category_lang (id_cms_category, id_lang)` because the PK is `(id_cms_category, id_shop, id_lang)` and our joins do not constrain `id_shop`.
- `idx_cms_category_parent_position_id` on `cms_category (id_parent, position, id_cms_category)` for parent/position operations.

Notes:
- Existing index names are fine if they cover the same columns in the same order.
- `cms_lang` does not need extra indexes when the PK is `(id_cms, id_shop, id_lang)` and queries join by `id_cms` with `id_shop`/`id_lang`.
- `cms_shop` does not need extra indexes beyond its PK `(id_cms, id_shop)`.

## What to run (tenant Presta DB)

1. Inspect current indexes:

```sql
SHOW INDEX FROM ps_cms;
SHOW INDEX FROM ps_cms_lang;
SHOW INDEX FROM ps_cms_category;
SHOW INDEX FROM ps_cms_category_lang;
SHOW INDEX FROM ps_cms_shop;
```

2. Apply only missing indexes:

```sql
ALTER TABLE ps_cms
    ADD INDEX idx_cms_position_id (position, id_cms),
    ADD INDEX idx_cms_category_position_id (id_cms_category, position, id_cms);

ALTER TABLE ps_cms_category_lang
    ADD INDEX idx_cms_category_lang_category_lang (id_cms_category, id_lang);

ALTER TABLE ps_cms_category
    ADD INDEX idx_cms_category_parent_position_id (id_parent, position, id_cms_category);
```

If you only want a minimal safe set first, apply just:

```sql
ALTER TABLE ps_cms
    ADD INDEX idx_cms_position_id (position, id_cms);

ALTER TABLE ps_cms_category_lang
    ADD INDEX idx_cms_category_lang_category_lang (id_cms_category, id_lang);
```
