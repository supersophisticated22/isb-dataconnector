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
