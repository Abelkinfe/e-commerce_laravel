<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductlinkController extends Controller
{
    
    public function productlink()
    {
        $user = User::find(auth()->user()->id);
        $parentCategories = [
            1 => 'FACE',
            2 => 'EYE',
            3 => 'LIP',
            4 => 'MAKEUP TOOL',
            5 => 'MAKEUP REMOVER'
        ];

        $result = [];

        foreach ($parentCategories as $parentCategoryId => $categoryName) {
            $categories = Category::where('parent_category_id', $parentCategoryId)->pluck('id');
            $products = Product::whereIn('category_id', $categories)->get(['name', 'product_img','category_id']);

            $result[$categoryName] = $products;
        }

        return response()->json($result);
    }
}
