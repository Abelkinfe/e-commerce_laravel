<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class CardlistController extends Controller
{
    public function cardlist()
    {
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->where('categories.parent_category_id', )
        ->orderBy('products.created_at', 'desc')
        ->take(4)
        ->get(['products.name', 'products.product_img']);

        return response()->json($products);
    }
}
