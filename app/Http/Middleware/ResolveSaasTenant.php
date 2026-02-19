<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use App\Models\TenantUser;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopConnection;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class ResolveSaasTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $plainTextToken = $this->resolvePlainTextToken($request);

        if ($plainTextToken === null) {
            return $this->unauthorizedResponse($request, 'saas.auth.missing_tenant_token');
        }

        $token = ApiToken::query()
            ->with('tenant')
            ->where('token_hash', hash('sha256', $plainTextToken))
            ->first();

        if ($token === null || $token->tenant === null) {
            return $this->unauthorizedResponse($request, 'saas.auth.invalid_tenant_token');
        }

        app(TenantContext::class)->setTenant($token->tenant);
        app(TenantPrestaShopConnection::class)->connect($token->tenant);

        $request->attributes->set('tenant_id', $token->tenant_id);
        $request->attributes->set('tenant', $token->tenant);

        $tenantUser = Auth::guard('tenant')->user();

        if ($tenantUser instanceof TenantUser && $tenantUser->tenant_id !== $token->tenant_id) {
            Auth::guard('tenant')->logout();
        }

        if ($tenantUser instanceof TenantUser && $tenantUser->tenant_id === $token->tenant_id) {
            Auth::shouldUse('tenant');
        }

        $token->forceFill(['last_used_at' => now()])->save();

        return $next($request);
    }

    private function resolvePlainTextToken(Request $request): ?string
    {
        $bearerToken = $request->bearerToken();

        if (is_string($bearerToken) && $bearerToken !== '') {
            return $bearerToken;
        }

        $headerToken = $request->header('X-Tenant-Token');

        if (is_string($headerToken) && $headerToken !== '') {
            return $headerToken;
        }

        return null;
    }

    private function unauthorizedResponse(Request $request, string $translationKey): Response
    {
        if ($this->isApiRequest($request)) {
            return response()->json(['message' => __($translationKey)], 401);
        }

        return $this->redirectToPanelLogin(__($translationKey));
    }

    private function redirectToPanelLogin(string $errorMessage): RedirectResponse
    {
        $loginUrl = Route::has('filament.saas.auth.login')
            ? route('filament.saas.auth.login')
            : '/saas/login';

        return redirect()
            ->guest($loginUrl)
            ->withErrors(['token' => $errorMessage]);
    }

    private function isApiRequest(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson() || $request->wantsJson();
    }
}
