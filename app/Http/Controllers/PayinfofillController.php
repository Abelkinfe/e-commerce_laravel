<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PayinfofillController extends Controller
{
    public function payinfo(){
        $payinfo = PaymentType::select(
            'value',
            'email',
            'first_name',
            'last_name',
            'phone_number'
        )
            ->join('payment_methods' , 'payment_types.id', 'payment_type_id');

        return response()->json($payinfo);
                                                   
    }
}
