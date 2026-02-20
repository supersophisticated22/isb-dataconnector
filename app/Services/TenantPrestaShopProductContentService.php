<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class TenantPrestaShopProductContentService
{
    /**
     * @var list<string>
     */
    private const CONTENT_FIELDS = [
        'name',
        'description_short',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'link_rewrite',
    ];

    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
        private PricingService $pricingService,
        private TypeSenseClient $typeSenseClient,
    ) {}

    /**
     * @return array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string}
     */
    public function getContent(int $productId, int $langId): array
    {
        $this->resolveTenantId();

        if ($productId < 1 || $langId < 1) {
            throw new RuntimeException('Product and language are required.');
        }

        $productLangTable = $this->tenantPrestaShopConnection->table('product_lang');

        /** @var object{name:?string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:?string}|null $row */
        $row = DB::connection('tenant_ps')
            ->table($productLangTable)
            ->where('id_product', $productId)
            ->where('id_lang', $langId)
            ->first(self::CONTENT_FIELDS);

        return [
            'name' => (string) data_get($row, 'name', ''),
            'description_short' => $this->nullableString(data_get($row, 'description_short')),
            'description' => $this->nullableString(data_get($row, 'description')),
            'meta_title' => $this->nullableString(data_get($row, 'meta_title')),
            'meta_description' => $this->nullableString(data_get($row, 'meta_description')),
            'meta_keywords' => $this->nullableString(data_get($row, 'meta_keywords')),
            'link_rewrite' => (string) data_get($row, 'link_rewrite', ''),
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function upsertContent(int $productId, int $langId, array $payload): void
    {
        $tenantId = $this->resolveTenantId();

        if ($productId < 1 || $langId < 1) {
            throw new RuntimeException('Product and language are required.');
        }

        $resolvedPayload = $this->resolvePayload($payload);
        $productLangTable = $this->tenantPrestaShopConnection->table('product_lang');

        DB::connection('tenant_ps')->transaction(function () use ($tenantId, $productId, $langId, $resolvedPayload, $productLangTable): void {
            $this->assertProductExists($productId);

            $exists = DB::connection('tenant_ps')
                ->table($productLangTable)
                ->where('id_product', $productId)
                ->where('id_lang', $langId)
                ->exists();

            if ($exists) {
                DB::connection('tenant_ps')
                    ->table($productLangTable)
                    ->where('id_product', $productId)
                    ->where('id_lang', $langId)
                    ->update($resolvedPayload);
            } else {
                $insertPayload = $this->resolveInsertPayload(
                    productLangTable: $productLangTable,
                    productId: $productId,
                    langId: $langId,
                    payload: $resolvedPayload,
                );

                DB::connection('tenant_ps')
                    ->table($productLangTable)
                    ->insert($insertPayload);
            }

            DB::connection('tenant_ps')->afterCommit(function () use ($tenantId, $productId): void {
                $this->syncTypeSenseProductDoc($tenantId, $productId);
            });
        });
    }

    private function resolveTenantId(): int
    {
        $tenantId = $this->tenantContext->tenantId();

        if (! is_int($tenantId) || $tenantId < 1) {
            throw new RuntimeException('Tenant context is missing.');
        }

        return $tenantId;
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string}
     */
    private function resolvePayload(array $payload): array
    {
        $name = trim((string) ($payload['name'] ?? ''));

        if ($name === '') {
            throw new RuntimeException('Product name is required.');
        }

        if (Str::length($name) > 255) {
            throw new RuntimeException('Product name may not be greater than 255 characters.');
        }

        $linkRewrite = $this->sanitizeSlug((string) ($payload['link_rewrite'] ?? ''));

        if ($linkRewrite === '') {
            throw new RuntimeException('Product slug is required.');
        }

        if (Str::length($linkRewrite) > 128) {
            $linkRewrite = trim(Str::substr($linkRewrite, 0, 128), '-');
        }

        if ($linkRewrite === '') {
            throw new RuntimeException('Product slug is invalid.');
        }

        $metaTitle = $this->nullableString($payload['meta_title'] ?? null);

        if ($metaTitle !== null && Str::length($metaTitle) > 255) {
            throw new RuntimeException('Meta title may not be greater than 255 characters.');
        }

        $metaDescription = $this->nullableString($payload['meta_description'] ?? null);

        if ($metaDescription !== null && Str::length($metaDescription) > 512) {
            throw new RuntimeException('Meta description may not be greater than 512 characters.');
        }

        return [
            'name' => $name,
            'description_short' => $this->nullableString($payload['description_short'] ?? null),
            'description' => $this->nullableString($payload['description'] ?? null),
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'meta_keywords' => $this->nullableString($payload['meta_keywords'] ?? null),
            'link_rewrite' => $linkRewrite,
        ];
    }

    /**
     * @param  array{name:string,description_short:?string,description:?string,meta_title:?string,meta_description:?string,meta_keywords:?string,link_rewrite:string}  $payload
     * @return array<string, mixed>
     */
    private function resolveInsertPayload(string $productLangTable, int $productId, int $langId, array $payload): array
    {
        $templateRow = DB::connection('tenant_ps')
            ->table($productLangTable)
            ->where('id_product', $productId)
            ->orderBy('id_lang')
            ->first();

        if ($templateRow === null) {
            $templateRow = DB::connection('tenant_ps')
                ->table($productLangTable)
                ->where('id_lang', $langId)
                ->orderBy('id_product')
                ->first();
        }

        if ($templateRow === null) {
            $templateRow = DB::connection('tenant_ps')
                ->table($productLangTable)
                ->orderBy('id_product')
                ->first();
        }

        /** @var array<string, mixed> $resolvedTemplate */
        $resolvedTemplate = is_object($templateRow) ? (array) $templateRow : [];

        $resolvedTemplate['id_product'] = $productId;
        $resolvedTemplate['id_lang'] = $langId;

        foreach ($payload as $column => $value) {
            $resolvedTemplate[$column] = $value;
        }

        if ($templateRow === null) {
            foreach ($this->resolveRequiredColumns($productLangTable) as $column => $type) {
                if (array_key_exists($column, $resolvedTemplate)) {
                    continue;
                }

                if (in_array($column, ['id_product', 'id_lang'], true)) {
                    continue;
                }

                $resolvedTemplate[$column] = $this->resolveRequiredColumnDefaultValue($type);
            }
        }

        return $resolvedTemplate;
    }

    /**
     * @return array<string, string>
     */
    private function resolveRequiredColumns(string $table): array
    {
        $driver = DB::connection('tenant_ps')->getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            return $this->resolveRequiredColumnsFromInformationSchema($table);
        }

        if ($driver === 'sqlite') {
            return $this->resolveRequiredColumnsFromSqlite($table);
        }

        return [];
    }

    /**
     * @return array<string, string>
     */
    private function resolveRequiredColumnsFromInformationSchema(string $table): array
    {
        $databaseName = DB::connection('tenant_ps')->getDatabaseName();

        if ($databaseName === '') {
            return [];
        }

        /** @var array<int, object{column_name:string,data_type:?string,column_default:mixed,is_nullable:string,extra:?string}> $rows */
        $rows = DB::connection('tenant_ps')
            ->table('information_schema.columns')
            ->where('table_schema', $databaseName)
            ->where('table_name', $table)
            ->get(['column_name', 'data_type', 'column_default', 'is_nullable', 'extra'])
            ->all();

        $columns = [];

        foreach ($rows as $row) {
            if (strtoupper((string) $row->is_nullable) === 'YES') {
                continue;
            }

            if ($row->column_default !== null) {
                continue;
            }

            if (Str::contains(strtolower((string) ($row->extra ?? '')), 'auto_increment')) {
                continue;
            }

            $columns[$row->column_name] = strtolower((string) ($row->data_type ?? ''));
        }

        return $columns;
    }

    /**
     * @return array<string, string>
     */
    private function resolveRequiredColumnsFromSqlite(string $table): array
    {
        $quotedTable = str_replace("'", "''", $table);

        /** @var array<int, object{name:string,type:string,notnull:int|string,dflt_value:mixed,pk:int|string}> $rows */
        $rows = DB::connection('tenant_ps')->select("PRAGMA table_info('{$quotedTable}')");

        $columns = [];

        foreach ($rows as $row) {
            if ((int) $row->notnull !== 1) {
                continue;
            }

            if ($row->dflt_value !== null) {
                continue;
            }

            if ((int) $row->pk === 1) {
                continue;
            }

            $columns[(string) $row->name] = strtolower((string) $row->type);
        }

        return $columns;
    }

    private function resolveRequiredColumnDefaultValue(string $columnType): mixed
    {
        if (Str::contains($columnType, ['int', 'decimal', 'float', 'double', 'real', 'numeric', 'bit', 'bool'])) {
            return 0;
        }

        if (Str::contains($columnType, ['date', 'time'])) {
            return '0000-00-00 00:00:00';
        }

        if (Str::contains($columnType, ['char', 'text', 'enum', 'set', 'json'])) {
            return '';
        }

        return '';
    }

    private function assertProductExists(int $productId): void
    {
        $productTable = $this->tenantPrestaShopConnection->table('product');

        $exists = DB::connection('tenant_ps')
            ->table($productTable)
            ->where('id_product', $productId)
            ->exists();

        if (! $exists) {
            throw new RuntimeException('Product not found in PrestaShop database.');
        }
    }

    private function sanitizeSlug(string $value): string
    {
        $slug = Str::of($value)
            ->trim()
            ->lower()
            ->ascii()
            ->replaceMatches('/[^a-z0-9]+/', '-')
            ->trim('-')
            ->value();

        return (string) $slug;
    }

    private function nullableString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $resolvedValue = trim((string) $value);

        return $resolvedValue === '' ? null : $resolvedValue;
    }

    private function syncTypeSenseProductDoc(int $tenantId, int $productId): void
    {
        try {
            $pricing = $this->pricingService->computeForProduct($productId);
            $productTable = $this->tenantPrestaShopConnection->table('product');
            $productLangTable = $this->tenantPrestaShopConnection->table('product_lang');
            $manufacturerTable = $this->tenantPrestaShopConnection->table('manufacturer');
            $categoryProductTable = $this->tenantPrestaShopConnection->table('category_product');

            /** @var object{reference:?string,active:int|string|bool,name:?string,manufacturer_name:?string}|null $product */
            $product = DB::connection('tenant_ps')
                ->table($productTable.' as p')
                ->leftJoin($manufacturerTable.' as m', 'm.id_manufacturer', '=', 'p.id_manufacturer')
                ->leftJoin($productLangTable.' as pl', 'pl.id_product', '=', 'p.id_product')
                ->where('p.id_product', $productId)
                ->orderBy('pl.id_lang')
                ->first([
                    'p.reference',
                    'p.active',
                    'pl.name',
                    DB::raw("COALESCE(m.name, '') as manufacturer_name"),
                ]);

            if ($product === null) {
                return;
            }

            /** @var list<string> $categoryIds */
            $categoryIds = DB::connection('tenant_ps')
                ->table($categoryProductTable)
                ->where('id_product', $productId)
                ->pluck('id_category')
                ->map(static fn (mixed $value): string => (string) $value)
                ->values()
                ->all();

            $this->typeSenseClient->ensureCollectionExists($tenantId);
            $this->typeSenseClient->upsertProductDoc($tenantId, [
                'id' => (string) $productId,
                'name' => (string) ($product->name ?? ''),
                'reference' => (string) ($product->reference ?? ''),
                'active' => (bool) $product->active,
                'manufacturer_name' => (string) ($product->manufacturer_name ?? ''),
                'category_ids' => $categoryIds,
                'original_price_tax_excl' => $pricing['original_price_tax_excl'],
                'current_price_tax_excl' => $pricing['current_price_tax_excl'],
                'original_price_tax_incl' => $pricing['original_price_tax_incl'],
                'current_price_tax_incl' => $pricing['current_price_tax_incl'],
                'discount_amount_tax_excl' => $pricing['discount_amount_tax_excl'],
                'discount_percent' => $pricing['discount_percent'],
                'product_url' => '/products/'.$productId,
                'image_url' => '',
                'updated_at' => now()->timestamp,
            ]);
        } catch (Throwable) {
        }
    }
}
