<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreCoupon extends Model
{
    protected $table = 'store_coupons';

    protected $fillable = [
        'code','type','value','max_redemptions','redeemed_count',
        'starts_at','ends_at','is_active'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(StoreOrder::class, 'coupon_id');
    }
}
