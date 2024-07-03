<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'currency',
        'email',
        'first_name',
        'last_name',
        'phone_number',
        'tx_ref',
        'product_id',
        'user_id',
    ];

    // Define relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
