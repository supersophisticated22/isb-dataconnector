<?php

namespace App\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

class ProductViewData
{
    public function __construct(
        public readonly string $formattedPrice,
        public readonly bool $discounted,
        public readonly string $stockStatus,
        public readonly bool $isActive,
    ) {}

    /**
     * @param  Model|array<string, mixed>  $record
     */
    public static function fromRecord(Model|array $record): self
    {
        $originalPriceTaxExcl = (float) data_get($record, 'original_price_tax_excl', 0);
        $currentPriceTaxExcl = (float) data_get($record, 'current_price_tax_excl', 0);
        $stockQty = (int) data_get($record, 'stock_qty', 0);

        return new self(
            formattedPrice: Number::currency($currentPriceTaxExcl, 'EUR'),
            discounted: $currentPriceTaxExcl < $originalPriceTaxExcl,
            stockStatus: $stockQty > 0 ? 'in_stock' : 'out_of_stock',
            isActive: (bool) data_get($record, 'active', false),
        );
    }
}
