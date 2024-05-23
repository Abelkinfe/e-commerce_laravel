<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    public function shoppingorder(){
        return $this->hasMany(ShoppingOrder::class);
        
    }
}
