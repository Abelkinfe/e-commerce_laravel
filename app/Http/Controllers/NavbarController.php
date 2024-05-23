<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function navbar(Request $request)
    {
        $user = User::find($request->user()->id); 

        if ($user) {
            return response()->json([
                'name' => $user->name,
                'user_image' => $user->user_image
                
            ]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

}
