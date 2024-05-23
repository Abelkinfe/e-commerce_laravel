<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['payment_type_id','bank_name','account_no'];
    public function paymenttype(){
        return $this->belongsTo(PaymentType::class);
    }
    public function shoppingorder(){
        return $this->hasMany(ShoppingOrder::class);
        
    }
}
