<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductSearchController extends Controller
{
    
    public function search(Request $request)
    {
        $name = $request->input('name');

        $request->validate([
            'name' => 'required|string'
        ]);

        $products = Product::where('name', 'like', "%{$name}%")
            ->with(['productItems.configItemProducts.varietyOption.variety'])
            ->get();

        $result = $products->flatMap(function ($product) {
            return $product->productItems->flatMap(function ($productItem) use ($product) {
                return $productItem->configItemProducts->map(function ($configItemProduct) use ($product, $productItem) {
                    return [
                        'name' => $product->name,
                        'description' => $product->description,
                        'product_img' => $product->product_img,
                        'price' => $productItem->price,
                        'qty_instock' => $productItem->qty_instock,
                        'variety_name' => $configItemProduct->varietyOption->variety->name,
                        'value' => $configItemProduct->varietyOption->value,
                    ];
                });
            });
        });

        return response()->json($result);
    }
}
