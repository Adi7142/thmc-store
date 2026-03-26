<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreProduct extends Model
{
    protected $table = 'store_products';

    protected $fillable = [
        'category_id','name','slug','description','type','is_active','sort_order','image_path'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(StoreCategory::class, 'category_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(StoreProductVariant::class, 'product_id');
    }
}
