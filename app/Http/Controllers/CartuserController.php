<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CartuserController extends Controller

{
    public function cartuser(){
        $user = User::find(auth()->user()->id);

        return response()->json($user);
    }
   
}
