<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;

class DetailpayController extends Controller
{
    public function initializeTransaction(Request $request)
    {
        
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'email' => 'required|email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'product_id' => 'required|exists:products,id',
        ]);

       
        
       $user = User::find(auth()->user()->id);

        
        $validatedData['user_id'] = $user->id;

      
        $transaction = Transaction::create($validatedData);

        
        $tx_ref = 'transaction-' . $transaction->id . '-' . time();

       
        $transaction->tx_ref = $tx_ref;
        $transaction->save();

        return response()->json([
            'status' => 'success',
            'tx_ref' => $tx_ref
        ]);
    }
}
