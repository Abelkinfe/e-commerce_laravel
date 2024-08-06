<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class NavlistController extends Controller
{
    public function navlist($id){
        $public = Product::select('');
    }
}
