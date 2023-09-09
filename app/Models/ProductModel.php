<?php

namespace App\Models;

use App\Repositories\ProductInventoryRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryModel::class);
    }

    public function image(): HasMany
    {
        return $this->hasMany(ProductImageModel::class);
    }

    public function discount(): HasMany
    {
        return $this->hasMany(DiscountModel::class);
    }

    public function inventory(): HasMany
    {
        return $this->hasMany(ProductInventoryModel::class, 'product_id', 'id');
    }
}
