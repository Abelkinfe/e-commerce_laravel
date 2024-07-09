<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PayproductdetailController extends Controller
{
    public function paydetail($id)
    {
        $product = Product::select(
                'products.id as product_id',
                'products.name as product_name',
                'product_items.price as product_price'
            )
            ->join('product_items', 'products.id', '=', 'product_items.product_id')
            ->join('config_item_products', 'product_items.id', '=', 'config_item_products.product_item_id')
            ->join('variety_options', 'config_item_products.variety_option_id', '=', 'variety_options.id')
            ->join('varieties', 'variety_options.variety_id', '=', 'varieties.id')
            ->where('products.id', $id)
            ->first();

        if ($product) {
            $response = [
                'id' => $product->product_id,
                'name' => $product->product_name,
                'price' => $product->product_price
            ];
            return response()->json($response);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }
}
