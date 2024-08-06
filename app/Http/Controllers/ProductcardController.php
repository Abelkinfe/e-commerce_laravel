<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
class ProductcardController extends Controller
{
    public function productcard()
    {
        $user = User::find(auth()->user()->id);
        $products = Product::with(['productItems'])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get(['id', 'name', 'product_img']);

          
        
        $data = $products->map(function($product) {
            $latestProductItem = $product->productItems->first(); 
            return [
               
                'name' => $product->name,
                'image' => $product->product_img,
                'qty_instock' => $latestProductItem->qty_instock,
                'price' => $latestProductItem->price,

            ];
        });

        return response()->json($data);
    }
}
