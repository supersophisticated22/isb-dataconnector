<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasTenants
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return HasMany<Job, $this>
     */
    public function createdJobs(): HasMany
    {
        return $this->hasMany(Job::class, 'created_by_user_id');
    }

    /**
     * @return HasMany<AuditLog, $this>
     */
    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class, 'actor_user_id');
    }

    /**
     * @return BelongsToMany<Tenant, $this>
     */
    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class)
            ->withPivot(['role', 'status', 'invited_by', 'last_seen_at'])
            ->withTimestamps();
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function hasPlatformAccess(): bool
    {
        return $this->isSuperAdmin();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasPlatformAccess();
        }

        if ($panel->getId() === 'app') {
            return $this->hasPlatformAccess() || $this->hasActiveTenantMembership();
        }

        return false;
    }

    /**
     * @return Collection<int, Tenant>
     */
    public function getTenants(Panel $panel): Collection
    {
        if ($this->hasPlatformAccess()) {
            return Tenant::query()
                ->where('status', 'active')
                ->orderBy('name')
                ->get();
        }

        return $this->tenants()
            ->wherePivot('status', 'active')
            ->get();
    }

    public function canAccessTenant(Model $tenant): bool
    {
        if (! $tenant instanceof Tenant) {
            return false;
        }

        if ($this->hasPlatformAccess()) {
            return true;
        }

        return $this->tenants()
            ->where('tenants.id', $tenant->getKey())
            ->wherePivot('status', 'active')
            ->exists();
    }

    public function canAccessTenantId(?int $tenantId): bool
    {
        if (! is_int($tenantId) || $tenantId < 1) {
            return false;
        }

        if ($this->hasPlatformAccess()) {
            return true;
        }

        return $this->tenants()
            ->where('tenants.id', $tenantId)
            ->wherePivot('status', 'active')
            ->exists();
    }

    public function hasActiveTenantMembership(): bool
    {
        return $this->tenants()
            ->wherePivot('status', 'active')
            ->exists();
    }

    public function isTenantAdmin(?int $tenantId = null): bool
    {
        if ($this->hasPlatformAccess()) {
            return true;
        }

        $query = $this->tenants()
            ->wherePivot('status', 'active')
            ->wherePivotIn('role', ['owner', 'admin']);

        if (is_int($tenantId)) {
            $query->where('tenants.id', $tenantId);
        }

        return $query->exists();
    }

    /**
     * @return array{role:string,status:string,invited_by:?int,last_seen_at:?string}|null
     */
    public function tenantMembership(int $tenantId): ?array
    {
        $membership = $this->tenants()
            ->where('tenants.id', $tenantId)
            ->first();

        if (! $membership instanceof Tenant) {
            return null;
        }

        /** @var object{role:string,status:string,invited_by:?int,last_seen_at:?string} $membershipPivot */
        $membershipPivot = $membership->pivot;

        $pivot = [
            'role' => (string) $membershipPivot->role,
            'status' => (string) $membershipPivot->status,
            'invited_by' => $membershipPivot->invited_by === null ? null : (int) $membershipPivot->invited_by,
            'last_seen_at' => $membershipPivot->last_seen_at,
        ];

        return $pivot;
    }

    public function canImpersonate(): bool
    {
        return $this->hasPlatformAccess();
    }

    public function canBeImpersonated(): bool
    {
        return ! $this->hasPlatformAccess();
    }
}
