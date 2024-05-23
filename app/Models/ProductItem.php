<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','qty_instock','price'];
    public function product(){

        return $this->belongsTo(Product::class);
    }
    public function varietyoptions(){
        return $this->belongsToMany(VarietyOption::class);
    }
    public function shoppingcartitem(){

        return $this->hasMany(ShoppingCartItem::class);
    }

}
