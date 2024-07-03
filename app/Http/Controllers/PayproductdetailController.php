<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PayproductdetailController extends Controller
{
    public function paydetail($id)
    {
        $products = Product::select('id','name','price')
        ->join('product_items', 'products.id', 'product_items.product_id')
        ->join('config_item_products', 'product_items.id', 'config_item_products.product_item_id')
        ->join('variety_options', 'config_item_products.variety_option_id', 'variety_options.id')
        ->join('varieties', 'vartiety_options.variety_id', 'varieties.id')->where('products.id', $id)->first();

    return response()->json($products);
    }
}
