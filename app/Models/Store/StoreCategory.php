<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreCategory extends Model
{
    protected $table = 'store_categories';

    protected $fillable = ['name', 'slug'];

    public function products(): HasMany
    {
        return $this->hasMany(StoreProduct::class, 'category_id');
    }
}
