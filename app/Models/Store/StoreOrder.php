<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StoreOrder extends Model
{
    protected $table = 'store_orders';

    protected $fillable = [
        'user_id','mc_username','status',
        'subtotal_cents','discount_cents','total_cents','currency',
        'coupon_id','payment_provider','payment_reference','paid_at','notes'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(StoreCoupon::class, 'coupon_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(StoreOrderItem::class, 'order_id');
    }

    public function fulfillment(): HasOne
    {
        return $this->hasOne(StoreFulfillment::class, 'order_id');
    }
}
