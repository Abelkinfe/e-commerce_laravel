<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function shoppingcartitems(){
        return $this->hasMany(ShoppingCartItem::class);
    }
    public function productitem()
    {
        return $this->belongsToMany(ProductItem::class,'shopping_cart_items');
    }
}
