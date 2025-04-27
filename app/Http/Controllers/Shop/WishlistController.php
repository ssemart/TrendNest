<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->with('product')
            ->get();
        return view('shop.wishlist', compact('wishlist'));
    }

    public function toggleWishlist(Request $request)
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['message' => 'Product removed from wishlist']);
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id
        ]);

        return response()->json(['message' => 'Product added to wishlist']);
    }
}
