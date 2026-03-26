<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreOrderItem extends Model
{
    protected $table = 'store_order_items';

    protected $fillable = [
        'order_id','product_id','variant_id',
        'name_snapshot','unit_price_cents','qty','line_total_cents','meta_snapshot'
    ];

    protected $casts = [
        'meta_snapshot' => 'array',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(StoreOrder::class, 'order_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(StoreProduct::class, 'product_id');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(StoreProductVariant::class, 'variant_id');
    }
}
