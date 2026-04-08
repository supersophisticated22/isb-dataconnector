<?php

namespace App\Providers;

use App\Models\User;
use App\Services\CmsPerformanceProbe;
use App\Services\TenantContext;
use App\Services\TenantPrestaShopCmsCategoryService;
use App\Services\TenantPrestaShopCmsPageService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use STS\FilamentImpersonate\Events\EnterImpersonation;
use STS\FilamentImpersonate\Events\LeaveImpersonation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TenantContext::class);
        $this->app->singleton(CmsPerformanceProbe::class);
        $this->app->singleton(TenantPrestaShopCmsPageService::class);
        $this->app->singleton(TenantPrestaShopCmsCategoryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-admin-panel', function (User $user): bool {
            return $user->hasPlatformAccess();
        });

        Gate::define('manage-tenant-settings', function (User $user): bool {
            return $user->isTenantAdmin($this->resolveCurrentTenantId());
        });

        Gate::define('view-tenant-products', function (User $user): bool {
            return $user->isTenantAdmin($this->resolveCurrentTenantId());
        });

        Gate::define('manage-tenant-bulk-price-updates', function (User $user): bool {
            return $user->isTenantAdmin($this->resolveCurrentTenantId());
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

        $this->app['events']->listen(EnterImpersonation::class, function (EnterImpersonation $event): void {
            if (! $event->impersonator instanceof User || ! $event->impersonated instanceof User) {
                return;
            }

            if (! Schema::hasTable('impersonation_logs')) {
                return;
            }

            $tenantId = $this->resolveImpersonationTenantId($event->impersonated);

            DB::table('impersonation_logs')->insert([
                'impersonator_user_id' => $event->impersonator->id,
                'impersonated_user_id' => $event->impersonated->id,
                'tenant_id' => $tenantId,
                'started_at' => now(),
                'ended_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('Impersonation started', [
                'impersonator_user_id' => $event->impersonator->id,
                'impersonated_user_id' => $event->impersonated->id,
                'tenant_id' => $tenantId,
            ]);
        });

        $this->app['events']->listen(LeaveImpersonation::class, function (LeaveImpersonation $event): void {
            if (! $event->impersonator instanceof User || ! $event->impersonated instanceof User) {
                return;
            }

            if (! Schema::hasTable('impersonation_logs')) {
                return;
            }

            $tenantId = $this->resolveImpersonationTenantId($event->impersonated);

            DB::table('impersonation_logs')
                ->where('impersonator_user_id', $event->impersonator->id)
                ->where('impersonated_user_id', $event->impersonated->id)
                ->whereNull('ended_at')
                ->latest('id')
                ->limit(1)
                ->update([
                    'ended_at' => now(),
                    'updated_at' => now(),
                ]);

            Log::info('Impersonation ended', [
                'impersonator_user_id' => $event->impersonator->id,
                'impersonated_user_id' => $event->impersonated->id,
                'tenant_id' => $tenantId,
            ]);
        });
    }

    private function resolveCurrentTenantId(): ?int
    {
        $tenantId = app(TenantContext::class)->tenantId();

        if (is_int($tenantId) && $tenantId > 0) {
            return $tenantId;
        }

        return null;
    }

    private function resolveImpersonationTenantId(User $user): ?int
    {
        $tenantId = $this->resolveCurrentTenantId();

        if (is_int($tenantId)) {
            return $tenantId;
        }

        $tenant = $user->tenants()->wherePivot('status', 'active')->first();

        return $tenant?->id;
    }
}
