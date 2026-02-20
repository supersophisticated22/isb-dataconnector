<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use RuntimeException;
use Throwable;

class TenantPrestaShopFeatureService
{
    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
    ) {}

    public function resolveInhoudFeatureId(int $langId): ?int
    {
        $tenantId = $this->resolveTenantId();

        if ($langId < 1) {
            return null;
        }

        $cacheKey = 'tenant_ps:'.$tenantId.':inhoud_feature_id';

        /** @var int|null $featureId */
        $featureId = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($langId): ?int {
            $configuredFeatureId = (int) config('prestashop.features.inhoud_id', 0);

            if ($configuredFeatureId > 0 && $this->featureExists($configuredFeatureId)) {
                return $configuredFeatureId;
            }

            return $this->lookupInhoudFeatureId($langId);
        });

        return $featureId;
    }

    public function getProductInhoud(int $productId, int $langId): ?string
    {
        $this->resolveTenantId();

        if ($productId < 1 || $langId < 1) {
            throw new RuntimeException('Product and language are required.');
        }

        $featureId = $this->resolveInhoudFeatureId($langId);

        if ($featureId === null) {
            return null;
        }

        $featureProductTable = $this->tenantPrestaShopConnection->table('feature_product');

        if (! $this->hasTable($featureProductTable)) {
            return null;
        }

        /** @var object{id_feature_value:mixed,custom_value:mixed}|null $row */
        $row = DB::connection('tenant_ps')
            ->table($featureProductTable)
            ->where('id_product', $productId)
            ->where('id_feature', $featureId)
            ->first();

        if ($row === null) {
            return null;
        }

        if ($this->hasColumn($featureProductTable, 'custom_value')) {
            $customValue = $this->nullableTrimmedString(data_get($row, 'custom_value'));

            if ($customValue !== null) {
                return $customValue;
            }
        }

        $featureValueId = (int) data_get($row, 'id_feature_value', 0);

        if ($featureValueId < 1) {
            return null;
        }

        $featureValueLangTable = $this->tenantPrestaShopConnection->table('feature_value_lang');

        if (! $this->hasTable($featureValueLangTable)) {
            return null;
        }

        $value = DB::connection('tenant_ps')
            ->table($featureValueLangTable)
            ->where('id_feature_value', $featureValueId)
            ->where('id_lang', $langId)
            ->value('value');

        if (is_string($value) && trim($value) !== '') {
            return trim($value);
        }

        $fallbackValue = DB::connection('tenant_ps')
            ->table($featureValueLangTable)
            ->where('id_feature_value', $featureValueId)
            ->orderBy('id_lang')
            ->value('value');

        return $this->nullableTrimmedString($fallbackValue);
    }

    public function upsertProductInhoud(int $productId, int $langId, string $value): void
    {
        $this->resolveTenantId();

        if ($productId < 1 || $langId < 1) {
            throw new RuntimeException('Product and language are required.');
        }

        $featureId = $this->resolveInhoudFeatureId($langId);

        if ($featureId === null) {
            throw new RuntimeException('Unable to resolve the "inhoud" feature.');
        }

        $featureProductTable = $this->tenantPrestaShopConnection->table('feature_product');

        if (! $this->hasTable($featureProductTable)) {
            throw new RuntimeException('Feature table is not available in the tenant database.');
        }

        /** @var object{id_feature_value:mixed,custom_value:mixed}|null $existing */
        $existing = DB::connection('tenant_ps')
            ->table($featureProductTable)
            ->where('id_product', $productId)
            ->where('id_feature', $featureId)
            ->first();

        $supportsCustomValue = $this->hasColumn($featureProductTable, 'custom_value');
        $supportsFeatureValueLink = $this->hasColumn($featureProductTable, 'id_feature_value');
        $supportsPredefinedValues = $supportsFeatureValueLink
            && $this->hasTable($this->tenantPrestaShopConnection->table('feature_value'))
            && $this->hasTable($this->tenantPrestaShopConnection->table('feature_value_lang'));

        $useCustomValue = $supportsCustomValue
            && (! $supportsPredefinedValues || $this->existingRowUsesCustomValue($existing));

        if ($useCustomValue) {
            $this->upsertCustomFeatureProductValue(
                featureProductTable: $featureProductTable,
                productId: $productId,
                featureId: $featureId,
                value: $this->nullableTrimmedString($value),
                existing: $existing,
                supportsFeatureValueLink: $supportsFeatureValueLink,
            );

            return;
        }

        $featureValueId = $this->resolveOrCreatePredefinedFeatureValue(
            featureId: $featureId,
            langId: $langId,
            value: trim($value),
        );

        $this->upsertPredefinedFeatureProductValue(
            featureProductTable: $featureProductTable,
            productId: $productId,
            featureId: $featureId,
            featureValueId: $featureValueId,
            existing: $existing,
            supportsCustomValue: $supportsCustomValue,
        );
    }

    private function resolveTenantId(): int
    {
        $tenantId = $this->tenantContext->tenantId();

        if (! is_int($tenantId) || $tenantId < 1) {
            throw new RuntimeException('Tenant context is missing.');
        }

        return $tenantId;
    }

    private function featureExists(int $featureId): bool
    {
        $featureTable = $this->tenantPrestaShopConnection->table('feature');

        if (! $this->hasTable($featureTable)) {
            return false;
        }

        return DB::connection('tenant_ps')
            ->table($featureTable)
            ->where('id_feature', $featureId)
            ->exists();
    }

    private function lookupInhoudFeatureId(int $langId): ?int
    {
        $featureLangTable = $this->tenantPrestaShopConnection->table('feature_lang');

        if (! $this->hasTable($featureLangTable)) {
            return null;
        }

        $featureId = DB::connection('tenant_ps')
            ->table($featureLangTable)
            ->where('id_lang', $langId)
            ->whereRaw('LOWER(name) = ?', ['inhoud'])
            ->value('id_feature');

        if (is_numeric($featureId) && (int) $featureId > 0) {
            return (int) $featureId;
        }

        $featureId = DB::connection('tenant_ps')
            ->table($featureLangTable)
            ->where('id_lang', $langId)
            ->whereRaw('LOWER(name) LIKE ?', ['%inhoud%'])
            ->value('id_feature');

        if (is_numeric($featureId) && (int) $featureId > 0) {
            return (int) $featureId;
        }

        $fallbackFeatureId = DB::connection('tenant_ps')
            ->table($featureLangTable)
            ->whereRaw('LOWER(name) = ?', ['inhoud'])
            ->value('id_feature');

        if (is_numeric($fallbackFeatureId) && (int) $fallbackFeatureId > 0) {
            return (int) $fallbackFeatureId;
        }

        $fallbackFeatureId = DB::connection('tenant_ps')
            ->table($featureLangTable)
            ->whereRaw('LOWER(name) LIKE ?', ['%inhoud%'])
            ->value('id_feature');

        if (is_numeric($fallbackFeatureId) && (int) $fallbackFeatureId > 0) {
            return (int) $fallbackFeatureId;
        }

        return null;
    }

    private function existingRowUsesCustomValue(?object $existing): bool
    {
        if ($existing === null) {
            return false;
        }

        $customValue = $this->nullableTrimmedString(data_get($existing, 'custom_value'));
        $featureValueId = (int) data_get($existing, 'id_feature_value', 0);

        return $customValue !== null && $featureValueId < 1;
    }

    private function upsertCustomFeatureProductValue(
        string $featureProductTable,
        int $productId,
        int $featureId,
        ?string $value,
        ?object $existing,
        bool $supportsFeatureValueLink,
    ): void {
        if ($existing !== null) {
            $updatePayload = [
                'custom_value' => $value,
            ];

            if ($supportsFeatureValueLink && (int) data_get($existing, 'id_feature_value', 0) < 1) {
                $updatePayload['id_feature_value'] = (int) data_get($existing, 'id_feature_value', 0);
            }

            DB::connection('tenant_ps')
                ->table($featureProductTable)
                ->where('id_product', $productId)
                ->where('id_feature', $featureId)
                ->update($updatePayload);

            return;
        }

        $insertPayload = [
            'id_product' => $productId,
            'id_feature' => $featureId,
            'custom_value' => $value,
        ];

        if ($supportsFeatureValueLink) {
            $insertPayload['id_feature_value'] = 0;
        }

        DB::connection('tenant_ps')
            ->table($featureProductTable)
            ->insert($insertPayload);
    }

    private function resolveOrCreatePredefinedFeatureValue(int $featureId, int $langId, string $value): int
    {
        $featureValueTable = $this->tenantPrestaShopConnection->table('feature_value');
        $featureValueLangTable = $this->tenantPrestaShopConnection->table('feature_value_lang');

        $existingId = DB::connection('tenant_ps')
            ->table($featureValueTable.' as fv')
            ->join($featureValueLangTable.' as fvl', 'fvl.id_feature_value', '=', 'fv.id_feature_value')
            ->where('fv.id_feature', $featureId)
            ->where('fvl.id_lang', $langId)
            ->where('fvl.value', $value)
            ->value('fv.id_feature_value');

        if (is_numeric($existingId) && (int) $existingId > 0) {
            return (int) $existingId;
        }

        $insertPayload = [
            'id_feature' => $featureId,
        ];

        if ($this->hasColumn($featureValueTable, 'custom')) {
            $insertPayload['custom'] = 0;
        }

        $featureValueId = $this->insertFeatureValueAndResolveId($featureValueTable, $insertPayload);
        $this->upsertFeatureValueLabelsForLanguages($featureValueId, $langId, $value);

        return $featureValueId;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function insertFeatureValueAndResolveId(string $featureValueTable, array $payload): int
    {
        try {
            $resolvedId = DB::connection('tenant_ps')
                ->table($featureValueTable)
                ->insertGetId($payload, 'id_feature_value');

            if ($resolvedId > 0) {
                return (int) $resolvedId;
            }
        } catch (Throwable) {
        }

        $nextId = ((int) DB::connection('tenant_ps')
            ->table($featureValueTable)
            ->max('id_feature_value')) + 1;

        DB::connection('tenant_ps')
            ->table($featureValueTable)
            ->insert([
                'id_feature_value' => $nextId,
                ...$payload,
            ]);

        return $nextId;
    }

    private function upsertFeatureValueLabelsForLanguages(int $featureValueId, int $langId, string $value): void
    {
        $featureValueLangTable = $this->tenantPrestaShopConnection->table('feature_value_lang');
        $langTable = $this->tenantPrestaShopConnection->table('lang');

        /** @var list<int> $languageIds */
        $languageIds = $this->hasTable($langTable)
            ? DB::connection('tenant_ps')
                ->table($langTable)
                ->pluck('id_lang')
                ->map(static fn (mixed $id): int => (int) $id)
                ->filter(static fn (int $id): bool => $id > 0)
                ->unique()
                ->values()
                ->all()
            : [];

        if ($languageIds === []) {
            $languageIds = [$langId];
        } elseif (! in_array($langId, $languageIds, true)) {
            $languageIds[] = $langId;
        }

        foreach ($languageIds as $languageId) {
            $exists = DB::connection('tenant_ps')
                ->table($featureValueLangTable)
                ->where('id_feature_value', $featureValueId)
                ->where('id_lang', $languageId)
                ->exists();

            if ($exists) {
                DB::connection('tenant_ps')
                    ->table($featureValueLangTable)
                    ->where('id_feature_value', $featureValueId)
                    ->where('id_lang', $languageId)
                    ->update(['value' => $value]);

                continue;
            }

            DB::connection('tenant_ps')
                ->table($featureValueLangTable)
                ->insert([
                    'id_feature_value' => $featureValueId,
                    'id_lang' => $languageId,
                    'value' => $value,
                ]);
        }
    }

    private function upsertPredefinedFeatureProductValue(
        string $featureProductTable,
        int $productId,
        int $featureId,
        int $featureValueId,
        ?object $existing,
        bool $supportsCustomValue,
    ): void {
        if ($existing !== null) {
            $updatePayload = [
                'id_feature_value' => $featureValueId,
            ];

            if ($supportsCustomValue) {
                $updatePayload['custom_value'] = null;
            }

            DB::connection('tenant_ps')
                ->table($featureProductTable)
                ->where('id_product', $productId)
                ->where('id_feature', $featureId)
                ->update($updatePayload);

            return;
        }

        $insertPayload = [
            'id_product' => $productId,
            'id_feature' => $featureId,
            'id_feature_value' => $featureValueId,
        ];

        if ($supportsCustomValue) {
            $insertPayload['custom_value'] = null;
        }

        DB::connection('tenant_ps')
            ->table($featureProductTable)
            ->insert($insertPayload);
    }

    private function nullableTrimmedString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $resolved = trim((string) $value);

        return $resolved === '' ? null : $resolved;
    }

    private function hasTable(string $table): bool
    {
        return Schema::connection('tenant_ps')->hasTable($table);
    }

    private function hasColumn(string $table, string $column): bool
    {
        if (! $this->hasTable($table)) {
            return false;
        }

        return Schema::connection('tenant_ps')->hasColumn($table, $column);
    }
}
