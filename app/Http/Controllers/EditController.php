<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


use Illuminate\Http\Request;


class EditController extends Controller
{
    public function update(Request $request)
    {
        // return $request->user();
        // $user = Auth::user();
        $user = User::find(auth()->user()->id);
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        if ($request->hasFile('image')) {
            $user_image = $request->file('image');
            $imageName = time() . '.' . $user_image->getClientOriginalExtension();
            $user_image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }
        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }
}
