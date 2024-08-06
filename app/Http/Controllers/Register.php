<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class Register extends Controller
{

public function register(Request $request){
   // Debugging log
   \Log::info('Request received', ['request' => $request->all(), 'file' => $request->file('userimage')]);

   $validatedData = $request->validate([
       'name' => 'required|string',
       'email' => 'required|email|unique:users',
       'password' => 'required|min:6',
       'userimage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
   ]);

   $userimage = null;

   if ($request->hasFile('userimage')) {
       $userimage = $request->file('userimage')->store('images', 'public');
   }

   $user = User::create([
       "name" => $validatedData['name'],
       "email" => $validatedData['email'],
       "password" => bcrypt($validatedData['password']),
       "user_image" => $userimage,
   ]);

   if ($user) {
        $imageData = base64_encode(Storage::disk('public')->get($userimage));
       $token = $user->createToken('personal token');
       $plaintext = $token->plainTextToken;

       
       return response()->json([
           'user' => $user,
           'token' => $plaintext,
           'imageData' => $imageData,
       ]);
   } else {
       return response()->json(['message' => 'User registration failed'], 500);
   }
}

  
}
