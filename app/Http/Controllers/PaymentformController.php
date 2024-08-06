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
            'first_name'=>'required|string',
            'last_name'=>'nullable|string|max:255',
            'email'=>'nullable|email|max:255',
            'phone_number'=>'nullable|string|',
            'value'=>'nullable|string|max:255'
        ]);
       
        $paymenttype = PaymentType::firstOrCreate([
            "value" => $data['value']
        ]);
           
        $paymentmethod = PaymentMethod::create([
            "first_name" => $data['first_name'],
            "last_name" => $data['last_name'],
            "email" => $data['email'],
            "phone_number" => $data['phone_number'],
            "payment_type_id" =>$paymenttype->id,
            "user_id"=>$user->id
        ]);
        
        $response = [
           
            "first_name" => $paymentmethod->first_name,
            "last_name" => $paymentmethod->last_name,
            "email" => $paymentmethod->email,
            "phone_number" => $paymentmethod->phone_number,
            "value" => $paymenttype->value,
            "user_id" => $user->id
        ];

        return response()->json($response);

   }
   public function getPaymentMethod(Request $request)
   {
           $user = User::find(auth()->user()->id);
       $paymentmethod = PaymentMethod::latest()->first();

       if ($paymentmethod) {
        
           $paymenttype = PaymentType::find($paymentmethod->payment_type_id);

           $response = [
               "first_name" => $paymentmethod->first_name,
               "last_name" => $paymentmethod->last_name,
               "email" => $paymentmethod->email,
               "phone_number" => $paymentmethod->phone_number,
               "value" => $paymenttype->value,
               "user_id" => $user->id
           ];

           return response()->json($response);
       } else {
           return response()->json(['message' => 'No payment method found.'], 404);
       }
   }
}
