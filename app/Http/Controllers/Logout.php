<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function logout(Request $request)
    {


        $request->User()->currentAccessToken()->delete();
        return response()->json(['get the fuck out']);




    }
}