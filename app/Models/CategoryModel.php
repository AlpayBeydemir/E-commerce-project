<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = ['name'];
    public function product(): HasMany
    {
        return $this->hasMany(ProductModel::class);
    }
}
