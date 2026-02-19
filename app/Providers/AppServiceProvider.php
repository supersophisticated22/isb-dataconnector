<?php

namespace App\Providers;

use App\Models\TenantUser;
use App\Models\User;
use App\Services\TenantContext;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TenantContext::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-admin-panel', function (User $user): bool {
            return $user->role === 'admin';
        });

        Gate::define('manage-tenant-settings', function (TenantUser $tenantUser): bool {
            return $tenantUser->isAdmin();
        });

        Gate::define('view-tenant-products', function (TenantUser $tenantUser): bool {
            return $tenantUser->tenant()->exists();
        });

        Gate::define('manage-tenant-bulk-price-updates', function (TenantUser $tenantUser): bool {
            return $tenantUser->isAdmin();
        });

        RateLimiter::for('tenant-token', function (Request $request): Limit {
            $plainTextToken = $request->bearerToken();

            if (! is_string($plainTextToken) || $plainTextToken === '') {
                $headerToken = $request->header('X-Tenant-Token');
                $plainTextToken = is_string($headerToken) ? $headerToken : '';
            }

            $limiterKey = $plainTextToken !== ''
                ? hash('sha256', $plainTextToken)
                : 'ip:'.$request->ip();

            return Limit::perMinute(60)->by($limiterKey);
        });
    }
}
