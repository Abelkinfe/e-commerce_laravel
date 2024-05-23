<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    public function shoppingorder(){
        return $this->belongsTo(ShoppingOrder::class);
    }
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
}
