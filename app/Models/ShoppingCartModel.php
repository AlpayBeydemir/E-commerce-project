<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartModel extends Model
{
    use HasFactory;
    protected $table = 'shopping_cart';
    protected $guarded = [];
}
