<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    protected function getCartIdentifier()
    {
        if (Auth::check()) {
            return ['user_id' => Auth::id(), 'session_id' => null];
        }
        
        if (!session()->has('cart_id')) {
            session(['cart_id' => Str::random(40)]);
        }
        
        return ['user_id' => null, 'session_id' => session('cart_id')];
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if ($product->stock_quantity < $request->quantity) {
            return response()->json([
                'message' => 'Not enough stock available'
            ], 422);
        }

        $cartIdentifier = $this->getCartIdentifier();
        
        $cartItem = Cart::updateOrCreate(
            array_merge(['product_id' => $request->product_id], $cartIdentifier),
            ['quantity' => $request->quantity]
        );

        $cartCount = Cart::where($cartIdentifier)->sum('quantity');

        return response()->json([
            'message' => 'Product added to cart successfully',
            'cart_count' => $cartCount
        ]);
    }

    public function viewCart()
    {
        $cartIdentifier = $this->getCartIdentifier();
        
        $cartItems = Cart::where($cartIdentifier)
            ->with(['product.productImages', 'product.store'])
            ->get();
            
        $subtotal = $cartItems->sum(function($item) {
            return ($item->product->discounted_price ?? $item->product->regular_price) * $item->quantity;
        });
        
        return view('frontend.cart', compact('cartItems', 'subtotal'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::findOrFail($request->cart_id);
        
        // Verify cart item belongs to current user/session
        $cartIdentifier = $this->getCartIdentifier();
        if ($cartItem->user_id != $cartIdentifier['user_id'] || 
            $cartItem->session_id != $cartIdentifier['session_id']) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        // Check stock availability
        if ($cartItem->product->stock_quantity < $request->quantity) {
            return response()->json([
                'message' => 'Not enough stock available'
            ], 422);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json([
            'message' => 'Cart updated successfully',
            'new_quantity' => $request->quantity,
            'new_subtotal' => number_format(($cartItem->product->discounted_price ?? $cartItem->product->regular_price) * $request->quantity, 2)
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id'
        ]);

        $cartItem = Cart::findOrFail($request->cart_id);
        
        // Verify cart item belongs to current user/session
        $cartIdentifier = $this->getCartIdentifier();
        if ($cartItem->user_id != $cartIdentifier['user_id'] || 
            $cartItem->session_id != $cartIdentifier['session_id']) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $cartItem->delete();

        $cartCount = Cart::where($cartIdentifier)->sum('quantity');

        return response()->json([
            'message' => 'Item removed from cart',
            'cart_count' => $cartCount
        ]);
    }

    public function mergeCart()
    {
        if (!Auth::check() || !session()->has('cart_id')) {
            return;
        }

        $sessionItems = Cart::where('session_id', session('cart_id'))->get();

        foreach ($sessionItems as $item) {
            Cart::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $item->product_id
                ],
                ['quantity' => $item->quantity]
            );
            $item->delete();
        }

        session()->forget('cart_id');
    }
}