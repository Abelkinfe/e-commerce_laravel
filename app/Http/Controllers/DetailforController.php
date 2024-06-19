<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DetailforController extends Controller
{
    public function detailfor($category_id)
    {
        try {
            // $user = User::find(auth()->user()->id);

            
            $products = Product::where('category_id', $category_id)
                ->with(['productItems.configItemProducts.varietyOption.variety'])
                ->get()
                ->map(function ($product) {
                    $productDetails = $product->productItems->map(function ($productItem) {
                        $varietyDetails = $productItem->configItemProducts->map(function ($configItemProduct) {
                            return [
                                'variety' => $configItemProduct->varietyOption->variety->name,
                                'variety_option' => $configItemProduct->varietyOption->value,
                            ];
                        })->first();

                        return [
                            'qty_instock' => $productItem->qty_instock,
                            'price' => $productItem->price,
                            'variety' => $varietyDetails['variety'] ?? null,
                            'variety_option' => $varietyDetails['variety_option'] ?? null,
                        ];
                    })->first();

                    return [
                        'name' => $product->name,
                        'description' => $product->description,
                        'product_img' => $product->product_img,
                        'qty_instock' => $productDetails['qty_instock'] ?? null,
                        'price' => $productDetails['price'] ?? null,
                        'variety' => $productDetails['variety'] ?? null,
                        'variety_option' => $productDetails['variety_option'] ?? null,
                    ];
                });

            // Log and return JSON response
            \Log::info('Products:', $products->toArray());

            if ($products->isEmpty()) {
                return response()->json([], 200);
            }

            return response()->json($products, 200, ['Content-Type' => 'application/json']);
        } catch (\Exception $e) {
            \Log::error('Error fetching products: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch products'], 500, ['Content-Type' => 'application/json']);
        }
    }
}
