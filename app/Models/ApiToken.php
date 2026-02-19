<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ApiToken extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'token_hash',
        'abilities',
        'last_used_at',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'token_hash',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'abilities' => 'array',
            'last_used_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Tenant, $this>
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function setTokenHashAttribute(string $value): void
    {
        $this->attributes['token_hash'] = ctype_xdigit($value) && strlen($value) === 64
            ? strtolower($value)
            : hash('sha256', $value);
    }

    /**
     * @param  array<int, string>  $abilities
     * @return array{0: self, 1: string}
     */
    public static function issue(int $tenantId, string $name, array $abilities = ['*']): array
    {
        $plainTextToken = Str::random(64);

        $token = self::query()->create([
            'tenant_id' => $tenantId,
            'name' => $name,
            'token_hash' => $plainTextToken,
            'abilities' => $abilities,
        ]);

        return [$token, $plainTextToken];
    }
}
