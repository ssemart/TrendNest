<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartIdentifier = auth()->check() 
            ? ['user_id' => auth()->id(), 'session_id' => null]
            : ['user_id' => null, 'session_id' => session('cart_id')];
        
        $cartItems = Cart::where($cartIdentifier)
            ->with(['product.productImages', 'product.store'])
            ->get();
            
        $subtotal = $cartItems->sum(function($item) {
            return ($item->product->discounted_price ?? $item->product->regular_price) * $item->quantity;
        });

        return view('shop.checkout', compact('cartItems', 'subtotal'));
    }

    public function process(Request $request)
    {
        // TODO: Implement order processing
        return redirect()->route('checkout')->with('success', 'Order placed successfully!');
    }
}
