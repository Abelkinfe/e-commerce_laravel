<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'product_img' => 'nullable|image',
            'qty_instock' => 'required|integer',
            'price' => 'required|numeric',
            'cata_name' => 'nullable|string',
            'parent_category_id' =>'nullable|integer'
        ]);

        

        $category = Category::firstOrCreate([
            'category_name' => $data['cata_name'],
            'parent_category_id'=>$data['parent_category_id']]);
            
            
        // $parentCategory = Category::firstOrCreate(
        //     ['category_name' => $data['category_name']]
        // );
        // $category = Category::firstOrCreate(
        //     ['category_name' => $data['category_name']]
        // );
        // $category->parent_category_id = $parentCategory->id;
        // $category->save();



             $cata_id = $category->id;

      
        $proImage = null;
        if ($request->hasFile('product_img')) {
            $proImage = $request->file('product_img')->store('proimages', 'public');
        }


        
        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'product_img' => $proImage,
            'creator_user_id'=>$user->id,
            'category_id' => $cata_id
           
        ]);


        $productItem = ProductItem::create([
            'qty_instock' => $data['qty_instock'],
            'price' => $data['price'],
            'product_id' => $product->id,

        ]);

        $parentCategory = null;
        if ($category->parent) {
            $parentCategory = $category->parent->category_name;
        }

        $responseData = [
            'message' => 'Data stored successfully',
            'username'=>$user->name,
            'product' => [
                'name' => $product->name,
                'description' => $product->description,
                'product_img' => $product->product_img,
                'price' => $productItem->price,
                'qty_instock' => $productItem->qty_instock,
                'category_name' => $category->category_name,
                'parent_category' => $parentCategory
            ]
        ];

        return response()->json($responseData, 201);

    }

}