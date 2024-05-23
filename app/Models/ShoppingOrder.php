<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingOrder extends Model
{
    use HasFactory;
    public function orderstatus(){
        return $this->belongsTo(OrderStatus::class);

    }
    public function shippingmethod(){
        return $this->belongsTo(ShippingMethod::class);
        
    }
    public function user(){
        return $this->belongsTo(User::class);
        
    }
    public function shippingaddress(){
        return $this->belongsTo(ShippingMethod::class);
        
    }
    public function paymentmethod(){
        return $this->belongsTo(PaymentMethod::class);
        
    }
}
