<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
        // Log the incoming request data for debugging
        Log::info('Form data:', $Request->all());

        // Validate the basic product information
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
        ]);

        // Create a URL-friendly slug from the product name
        $slug = Str::slug($Request->product_name, '-');

        // Create the product record
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
            'stock_status' => $Request->stock_quantity > 0 ? 'in_stock' : 'out_of_stock',
            'visibility' => $Request->has('visibility'),
            'slug' => $slug,
            'meta_title' => $Request->meta_title ?? $Request->product_name,
            'meta_description' => $Request->meta_description ?? substr($Request->description, 0, 160),
            'status' => 'published', // Changed from 'active' to 'published'
            'stock_status' => $Request->stock_quantity > 0 ? Product::STOCK_STATUS_IN_STOCK : Product::STOCK_STATUS_OUT_OF_STOCK
        ]);

        // Handle image uploads with separate validation
        if ($Request->hasFile('images')) {
            // Validate images separately
            $Request->validate([
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
            $isPrimary = true; // First image will be primary
            
            foreach ($Request->file('images') as $file) {
                $path = $file->store('product-images', 'public');
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_path' => $path,
                    'is_primary' => $isPrimary,
                ]);
                
                $isPrimary = false; // Subsequent images are not primary
            }
        }
        
        return redirect()->route('vendor.product.manage')->with('success', 'Product added successfully');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        
        // Check if the product belongs to the current seller
        if ($product->seller_id != Auth::id()) {
            return redirect()->route('vendor.product.manage')->with('error', 'You are not authorized to edit this product');
        }
        
        $authuserid = Auth::id();
        $stores = store::where('user_id', $authuserid)->get();
        
        return view('seller.product.edit', compact('product', 'stores'));
    }
    
    public function update(Request $Request, $id) {
        $product = Product::findOrFail($id);
        
        // Check if the product belongs to the current seller
        if ($product->seller_id != Auth::id()) {
            return redirect()->route('vendor.product.manage')->with('error', 'You are not authorized to edit this product');
        }
        
        // Validate the basic product information
        $Request->validate ([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku,'.$id,
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'stock_quantity' => 'required|integer|min:0',
        ]);
        
        // Update the product record
        $product->update([
            'product_name' => $Request->product_name,
            'description' => $Request->description,
            'sku' => $Request->sku,
            'category_id' => $Request->category_id,
            'subcategory_id' => $Request->subcategory_id,
            'store_id' => $Request->store_id,
            'regular_price' => $Request->regular_price,
            'discounted_price' => $Request->discounted_price,
            'tax_rate' => $Request->tax_rate,
            'stock_quantity' => $Request->stock_quantity,
            'stock_status' => $Request->stock_quantity > 0 ? 'in_stock' : 'out_of_stock',
            'visibility' => $Request->has('visibility'),
            'slug' => Str::slug($Request->product_name, '-'),
            'meta_title' => $Request->meta_title ?? $Request->product_name,
            'meta_description' => $Request->meta_description ?? substr($Request->description, 0, 160),
        ]);
        
        // Handle new image uploads if any
        if ($Request->hasFile('images')) {
            // Validate images separately
            $Request->validate([
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
            $hasPrimary = $product->productImages()->where('is_primary', true)->exists();
            
            foreach ($Request->file('images') as $file) {
                $path = $file->store('product-images', 'public');
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_path' => $path,
                    'is_primary' => !$hasPrimary, // Set as primary only if no primary image exists
                ]);
                
                $hasPrimary = true; // After adding first image, we have a primary
            }
        }
        
        return redirect()->route('vendor.product.manage')->with('success', 'Product updated successfully');
    }
    
    public function destroy($id) {
        $product = Product::findOrFail($id);
        
        // Check if the product belongs to the current seller
        if ($product->seller_id != Auth::id()) {
            return redirect()->route('vendor.product.manage')->with('error', 'You are not authorized to delete this product');
        }
        
        // Delete associated images first
        foreach ($product->productImages as $image) {
            // Delete the file from storage
            if (Storage::disk('public')->exists($image->img_path)) {
                Storage::disk('public')->delete($image->img_path);
            }
            $image->delete();
        }
        
        // Delete the product
        $product->delete();
        
        return redirect()->route('vendor.product.manage')->with('success', 'Product deleted successfully');
    }
}
