<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Http\Request;

class GetsellproductController extends Controller
{
    public function getproducts(Request $request)
    {
        // $user = User::find(auth()->user()->id);
        // $categories = Category::whereNull('parent_category_id')->get(['id', 'category_name']);
        // return response()->json($categories);

        if (!$request->user()) {
            
            return response()->json(['error' => 'User token not found'], 401);
        }
    
        try {
           
            $user = User::findOrFail(auth()->user()->id);
    
           
            $categories = Category::whereNull('parent_category_id')->get(['id', 'category_name']);
    
           
            return response()->json($categories);
        } catch (\Exception $e) {
           
            return response()->json(['error' => 'Failed to retrieve products'], 500);
        }
    }

}
