<?php

namespace App\Models;

use App\Services\TenantPrestaShopConnection;
use Illuminate\Database\Eloquent\Model;

class TenantPrestaShopSpecificPrice extends Model
{
    protected $connection = 'tenant_ps';

    protected $primaryKey = 'id_specific_price';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id_product',
        'id_product_attribute',
        'price',
        'reduction',
        'reduction_type',
        'from',
        'to',
    ];

    public function getTable(): string
    {
        return app(TenantPrestaShopConnection::class)->table('specific_price');
    }
}
