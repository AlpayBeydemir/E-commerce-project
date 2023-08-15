<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImageModel extends Model
{
    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class);
    }
}
