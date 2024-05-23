<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function user()
    {
        $users = User::all();
        return response()->json(['status' => 'success', 'data' => $users]);
    }
}
