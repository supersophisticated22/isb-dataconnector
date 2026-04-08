<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Throwable;

class TenantPrestaShopConnection
{
    public function __construct(private TenantContext $tenantContext) {}

    public function connect(?Tenant $tenant = null): bool
    {
        $resolvedTenant = $this->resolveTenant($tenant);

        if ($resolvedTenant === null) {
            return false;
        }

        config()->set('database.connections.tenant_ps', [
            'driver' => 'mariadb',
            'host' => $resolvedTenant->db_host,
            'port' => $resolvedTenant->db_port,
            'database' => $resolvedTenant->db_name,
            'username' => $resolvedTenant->db_user,
            'password' => $this->resolvePassword($resolvedTenant),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => [],
        ]);

        try {
            DB::purge('tenant_ps');
            DB::reconnect('tenant_ps');

            return true;
        } catch (Throwable $exception) {
            Log::warning('Unable to connect to tenant PrestaShop database.', [
                'tenant_id' => $resolvedTenant->id,
                'message' => $exception->getMessage(),
            ]);

            return false;
        }
    }

    public function table(string $name, ?Tenant $tenant = null): string
    {
        if (! preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
            throw new InvalidArgumentException('Invalid PrestaShop table name.');
        }

        $prefix = $this->sanitizePrefix($this->resolveTenant($tenant)?->db_prefix ?? 'ps_');

        return $prefix.$name;
    }

    public function testConnection(?Tenant $tenant = null): bool
    {
        if (! $this->connect($tenant)) {
            return false;
        }

        try {
            DB::connection('tenant_ps')->select('select 1');

            return true;
        } catch (Throwable $exception) {
            Log::warning('Tenant PrestaShop connection health check failed.', [
                'tenant_id' => $this->resolveTenant($tenant)?->id,
                'message' => $exception->getMessage(),
            ]);

            return false;
        }
    }

    public function onboard(?Tenant $tenant = null): bool
    {
        $resolvedTenant = $this->resolveTenant($tenant);

        if ($resolvedTenant === null || ! $this->testConnection($resolvedTenant)) {
            return false;
        }

        $baseShopUrl = $this->fetchBaseShopUrl($resolvedTenant);

        if ($baseShopUrl === null) {
            return false;
        }

        $resolvedTenant->forceFill([
            'base_shop_url' => $baseShopUrl,
        ])->save();

        return true;
    }

    private function fetchBaseShopUrl(Tenant $tenant): ?string
    {
        try {
            /** @var object{domain:string,domain_ssl:?string,physical_uri:?string,virtual_uri:?string}|null $row */
            $row = DB::connection('tenant_ps')
                ->table($this->table('shop_url', $tenant))
                ->where('main', 1)
                ->orderBy('id_shop_url')
                ->first(['domain', 'domain_ssl', 'physical_uri', 'virtual_uri']);

            if ($row === null) {
                return null;
            }

            $host = $row->domain_ssl ?: $row->domain;
            $path = $this->normalizePath($row->physical_uri, $row->virtual_uri);

            return 'https://'.$host.$path;
        } catch (Throwable $exception) {
            Log::warning('Unable to resolve tenant PrestaShop base shop URL.', [
                'tenant_id' => $tenant->id,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    private function resolveTenant(?Tenant $tenant = null): ?Tenant
    {
        return $tenant ?? $this->tenantContext->getTenant();
    }

    private function resolvePassword(Tenant $tenant): string
    {
        return $tenant->db_password ?? '';
    }

    private function sanitizePrefix(?string $prefix): string
    {
        $resolvedPrefix = is_string($prefix) ? $prefix : 'ps_';
        $sanitizedPrefix = (string) preg_replace('/[^a-zA-Z0-9_]/', '', $resolvedPrefix);

        return $sanitizedPrefix !== '' ? $sanitizedPrefix : 'ps_';
    }

    private function normalizePath(?string $physicalUri, ?string $virtualUri): string
    {
        $path = trim(($physicalUri ?? '').($virtualUri ?? ''));

        if ($path === '') {
            return '/';
        }

        $normalizedPath = '/'.trim($path, '/');

        return str_ends_with($normalizedPath, '/') ? $normalizedPath : $normalizedPath.'/';
    }
}
