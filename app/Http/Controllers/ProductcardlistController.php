<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductcardlistController extends Controller
{
    public function productcardlist(Request $request)
    {
        
        $latestProducts = Product::orderBy('created_at', 'desc')
            ->take(10)
            ->get(['id', 'name', 'product_img','category_id']);

        $categories = [1, 2, 3, 4, 5];
        $productsByCategory = [];

        foreach ($categories as $categoryId) {
           
            $products = Product::whereHas('category', function ($query) use ($categoryId) {
                    $query->where('parent_category_id', $categoryId);
                })
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get(['category_id', 'name', 'product_img']);

            $productsByCategory[$categoryId] = $products;
        }

        return response()->json([
            'latest_products' => $latestProducts,
            'products_by_category' => $productsByCategory
        ]);
    }
}
