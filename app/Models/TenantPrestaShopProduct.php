<?php

namespace App\Models;

use App\Services\TenantPrestaShopConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TenantPrestaShopProduct extends Model
{
    protected $connection = 'tenant_ps';

    protected $primaryKey = 'id_product';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    public function getTable(): string
    {
        return app(TenantPrestaShopConnection::class)->table('product');
    }

    public function specificPrices(): HasMany
    {
        return $this->hasMany(TenantPrestaShopSpecificPrice::class, 'id_product', 'id_product')
            ->where('id_product_attribute', 0)
            ->where(function ($query): void {
                $query->where('from', '0000-00-00 00:00:00')
                    ->orWhere('from', '<=', now()->format('Y-m-d H:i:s'));
            })
            ->where(function ($query): void {
                $query->where('to', '0000-00-00 00:00:00')
                    ->orWhere('to', '>=', now()->format('Y-m-d H:i:s'));
            });
    }
}
