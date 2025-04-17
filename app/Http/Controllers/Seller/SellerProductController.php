<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Importing Log facade
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index(){
        $authuserid = Auth::id();
        $stores = store::where('user_id', $authuserid)->get();
        return view('seller.product.create', compact('stores'));
        
    }

    public function manage(){
        $currentseller = Auth::id();
        $products = Product::where('seller_id', $currentseller)->get();
        return view('seller.product.manage', compact('products'));
        
    }

    public function storeproduct(Request $Request){
        $Request->validate ([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Changed from 'images' to 'images.*'
        ]);
    

        $product = Product::create([
            'product_name' => $Request->product_name,
            'description' => $Request->description,
            'sku' => $Request->sku,
            'seller_id' => Auth::id(),
            'category_id' => $Request->category_id,
            'subcategory_id' => $Request->subcategory_id,
            'store_id' => $Request->store_id,
            'regular_price' => $Request->regular_price,
            'discounted_price' => $Request->discounted_price,
            'tax_rate' => $Request->tax_rate,
            'stock_quantity' => $Request->stock_quantity,
            'slug' => $Request ->slug,
            'meta_title' => $Request ->meta_title,
            'meta_description' => $Request ->meta_description,
        ]);

        // Handle multiple image upload
        if ($Request->hasFile('images')) {
            foreach ($Request->file('images') as $file) {
                $path = $file->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }
        return redirect()->back()->with('message', 'Product Added successfully');
    }
}
