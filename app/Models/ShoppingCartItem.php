<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    use HasFactory;
    public function productitem(){
        return $this->belongsTo(ProductItem::class);
    }
    public function shoppingcartid(){
        return $this->belongsTo(ShoppingCart::class);
    }
}
