<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with(['category', 'store', 'productImages'])->get();
        return view('admin.product.manage', compact('products'));
    }

    public function create(){
        $categories = Category::all();
        $stores = Store::all();
        return view('admin.product.create', compact('categories', 'stores'));
    }

    public function store(Request $request){
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'sku' => $request->sku,
            'seller_id' => Auth::id(),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'store_id' => $request->store_id,
            'regular_price' => $request->regular_price,
            'discounted_price' => $request->discounted_price,
            'tax_rate' => $request->tax_rate,
            'stock_quantity' => $request->stock_quantity,
            'stock_status' => $request->stock_quantity > 0 ? Product::STOCK_STATUS_IN_STOCK : Product::STOCK_STATUS_OUT_OF_STOCK,
            'slug' => Str::slug($request->product_name),
            'visibility' => $request->visibility ?? true,
            'meta_title' => $request->meta_title ?? $request->product_name,
            'meta_description' => $request->meta_description ?? Str::limit($request->description, 160),
            'status' => 'published'
        ]);

        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $path = $image->store('product-images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product created successfully');
    }

    public function edit($id){
        $product = Product::with(['category', 'store', 'productImages'])->findOrFail($id);
        $categories = Category::all();
        $stores = Store::all();
        return view('admin.product.edit', compact('product', 'categories', 'stores'));
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);
        
        $request->validate([
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'store_id' => $request->store_id,
            'regular_price' => $request->regular_price,
            'discounted_price' => $request->discounted_price,
            'tax_rate' => $request->tax_rate,
            'stock_quantity' => $request->stock_quantity,
            'stock_status' => $request->stock_quantity > 0 ? Product::STOCK_STATUS_IN_STOCK : Product::STOCK_STATUS_OUT_OF_STOCK,
            'visibility' => $request->has('visibility'),
            'meta_title' => $request->meta_title ?? $request->product_name,
            'meta_description' => $request->meta_description ?? Str::limit($request->description, 160),
        ]);

        if($request->hasFile('images')){
            // Delete old images if requested
            if($request->has('delete_images')){
                foreach($product->productImages as $image){
                    Storage::disk('public')->delete($image->img_path);
                    $image->delete();
                }
            }
            
            // Add new images
            foreach($request->file('images') as $image){
                $path = $image->store('product-images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        
        // Delete associated images from storage
        foreach($product->productImages as $image){
            Storage::disk('public')->delete($image->img_path);
        }
        
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }

    public function deleteImage($id) {
        try {
            $image = ProductImage::with('product')->findOrFail($id);
            
            // Delete the file from storage
            if (Storage::disk('public')->exists($image->img_path)) {
                Storage::disk('public')->delete($image->img_path);
            }
            
            // Manually delete the image record to avoid cascade
            DB::beginTransaction();
            try {
                $image->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to delete image. Please try again.');
            }
            
            // Check remaining images and update primary if needed
            $remainingImages = ProductImage::where('product_id', $image->product_id)->get();
            if ($remainingImages->isNotEmpty() && !$remainingImages->contains('is_primary', true)) {
                $firstImage = $remainingImages->first();
                $firstImage->update(['is_primary' => true]);
            }
            
            return redirect()->back()->with('success', 'Image deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete image. Please try again.');
        }
    }

    public function review_manage(){
        return view('admin.product.mange_product_review');
    }
}
