<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Variety;
use App\Models\ConfigItemProduct;
use App\Models\VarietyOption;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);

        try {
            $data = $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'qty_instock' => 'required|integer',
                'price' => 'required|numeric',
                'cata_name' => 'nullable|string',
                'parent_category_id' => 'nullable|integer',
                'variety_option'=>'required|string',
                'variety_name' => 'required|string' 
                
               
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        }

        
        $category = Category::firstOrCreate([
            'category_name' => $data['cata_name'],
            'parent_category_id' => $data['parent_category_id']
        ]);

        $cata_id = $category->id;

       
        $proImage = null;
        if ($request->hasFile('product_img')) {
            $proImage = $request->file('product_img')->store('proimages', 'public');
        } else {
            error_log('File is not present');
        }

       
        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'product_img' => $proImage,
            'creator_user_id' => $user->id,
            'category_id' => $cata_id
        ]);

       
        $productItem = ProductItem::create([
            'qty_instock' => $data['qty_instock'],
            'price' => $data['price'],
            'product_id' => $product->id,
        ]);

        
        $variety = Variety::firstOrCreate([
            'name' => $data['variety_name']
        ]);
        $varietyoption = VarietyOption::firstOrCreate([
            'variety_id'=>$variety->id,
            'value'=>$data['variety_option']

        ]);
      
        ConfigItemProduct::create([
            'product_item_id' => $productItem->id,
            'variety_option_id' => $variety->id
        ]);
        
        
        $parentCategory = null;
        if ($category->parent) {
            $parentCategory = $category->parent->category_name;
        }

        // Prepare JSON response data
        $responseData = [
            'message' => 'Data stored successfully',
            'username' => $user->name,
            'product' => [
                'name' => $product->name,
                'description' => $product->description,
                'product_img' => $product->product_img,
                'price' => $productItem->price,
                'qty_instock' => $productItem->qty_instock,
                'category_name' => $category->category_name,
                'parent_category' => $parentCategory,
                'variety_option'=>$varietyoption->value,
                'variety_name' => $variety->name 
              
            ]
        ];

        return response()->json($responseData, 201);
    }
}
