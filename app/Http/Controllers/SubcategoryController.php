<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function subcategory($categoryId)
    {
       
        $subcategories = Category::where('parent_category_id', $categoryId)->get();

        return response()->json($subcategories);
    }
}
