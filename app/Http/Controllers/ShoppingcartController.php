<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use Illuminate\Http\Request;

class ShoppingcartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $product_id = $request->product_id;
        $user_id = $request->user_id;

       
        $shoppingCart = ShoppingCart::firstOrCreate(['user_id' => $user_id]);

        
        $productItem = ProductItem::where('product_id', $product_id)->first();

     

       
        ShoppingCartItem::create([
            'shopping_cart_id' => $shoppingCart->id,
            'product_item_id' => $productItem->id
        ]);

        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function getCartDetails(Request $request, $user_id)
{
    $cart = ShoppingCart::with('productitem.product')
        ->where('user_id', $user_id)
        ->first();

        

    if (!$cart) {
        return response()->json(['error' => 'Cart not found'], 404);
    }

    $cartDetails = $cart->productitem->map(function ($item) {
        $product = $item->product;
        if ($product) {
            return [
                'name' => $product->name,
                'description' => $product->description,
                'product_img' => $product->product_img,
                'price' => $item->price,
            ];
        }

        return null; 
    })->filter();

   
    return response()->json($cartDetails);
}

public function deleteFromCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'user_id' => 'required|exists:users,id'
    ]);

    $product_id = $request->product_id;
    $user_id = $request->user_id;

   
    $shoppingCart = ShoppingCart::where('user_id', $user_id)->first();

    if (!$shoppingCart) {
        return response()->json(['error' => 'Cart not found'], 404);
    }


    $productItem = ProductItem::where('product_id', $product_id)->first();
    if ($productItem) {
        ShoppingCartItem::where('shopping_cart_id', $shoppingCart->id)
            ->where('product_item_id', $productItem->id)
            ->delete();
        
        return response()->json(['message' => 'Product removed from cart successfully']);
    }

    return response()->json(['error' => 'Product not found in cart'], 404);
}





}
