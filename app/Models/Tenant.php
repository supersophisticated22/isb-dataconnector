<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'db_host',
        'db_port',
        'db_name',
        'db_user',
        'db_password',
        'db_password_encrypted',
        'db_prefix',
        'base_shop_url',
        'status',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'db_password',
        'db_password_encrypted',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'db_port' => 'integer',
            'db_password' => 'encrypted',
        ];
    }

    protected function dbPasswordEncrypted(): Attribute
    {
        return Attribute::make(
            get: fn (): ?string => $this->attributes['db_password'] ?? null,
            set: fn (?string $value): array => ['db_password' => $value],
        );
    }

    /**
     * @return HasMany<User, $this>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return HasMany<ApiToken, $this>
     */
    public function apiTokens(): HasMany
    {
        return $this->hasMany(ApiToken::class);
    }

    /**
     * @return HasMany<Job, $this>
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    /**
     * @return HasMany<AuditLog, $this>
     */
    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }
}
