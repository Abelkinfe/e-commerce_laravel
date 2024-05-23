<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !password_verify($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        
        $token = $user->createToken('personal token');
        $plaintext = $token->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $plaintext,
        ]);
    }
}
