<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartCollection;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $products = Cart::with("product")->get();
        return new CartCollection($products);
    }

    public function add(Product $product)
    {
        $cartItem = Cart::where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            Cart::create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }
        return response()->json(['message' => 'Product created']);
    }

    public function clearCart()
    {
        Cart::truncate();
        return response()->json(['message' => 'Success']);
    }
}
