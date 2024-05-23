<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Content extends Controller
{

    public function index()
    {
        $content = Product::all(['product_img']);
    }
}
