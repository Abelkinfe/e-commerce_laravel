<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','last_name','email','phone_number','value','payment_type_id'];
    public function paymenttype(){
        return $this->belongsTo(PaymentType::class);
    }
    public function shoppingorder(){
        return $this->hasMany(ShoppingOrder::class);
        
    }
}
