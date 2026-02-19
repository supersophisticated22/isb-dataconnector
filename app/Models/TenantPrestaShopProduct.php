<?php

namespace App\Models;

use App\Services\TenantPrestaShopConnection;
use Illuminate\Database\Eloquent\Model;

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
}
