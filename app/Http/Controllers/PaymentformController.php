<?php

namespace App\Http\Controllers;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentformController extends Controller
{
   public function paymentform(Request $request){
    
    $user = User::find(auth()->user()->id);
        $data = $request->validate([
            'bank_name'=>'nullable|string',
            'account_no'=>'nullable|string|max:255',
            'value'=>'nullable|string|max:255'
        ]);


        $paymenttype = PaymentType::firstOrCreate([
            "value" => $data['value']
        ]);
           
        $paymentmethod = PaymentMethod::create([
            "bank_name" => $data['bank_name'],
            "account_no" => $data['account_no'],
            "payment_type_id" =>$paymenttype->id,
            "user_id"=>$user->id
        ]);

        $response = [
            "message" => "granted",
            "bank_name" => $paymentmethod->bank_name,
            "account_no" => $paymentmethod->account_no,
            "value" => $paymenttype->value
        ];

        return response()->json($response);

   }
}
