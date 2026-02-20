<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopConnection;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveFilamentTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = $this->resolveTenant($request);

        if ($tenant instanceof Tenant) {
            app(TenantContext::class)->setTenant($tenant);
            app(TenantPrestaShopConnection::class)->connect($tenant);

            $request->attributes->set('tenant_id', $tenant->id);
            $request->attributes->set('tenant', $tenant);
        }

        return $next($request);
    }

    private function resolveTenant(Request $request): ?Tenant
    {
        $currentFilamentTenant = Filament::getTenant();

        if ($currentFilamentTenant instanceof Tenant) {
            return $currentFilamentTenant;
        }

        $routeTenant = $request->route('tenant');

        if ($routeTenant instanceof Tenant) {
            return $routeTenant;
        }

        if (is_string($routeTenant) && $routeTenant !== '') {
            return Tenant::query()
                ->where('slug', $routeTenant)
                ->first();
        }

        return null;
    }
}
