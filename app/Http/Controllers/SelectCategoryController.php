<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SelectCategoryController extends Controller
{
    public function getMainCategories()
    {
        $mainCategories = Category::select('id', 'category_name')
                                  ->whereNull('parent_category_id')
                                  ->get()
                                  ->map(function ($category) {
                                      return [
                                          'id' => $category->id,
                                          'name' => $category->category_name,
                                      ];
                                  })->toArray();

        return response()->json($mainCategories);
    }
}
