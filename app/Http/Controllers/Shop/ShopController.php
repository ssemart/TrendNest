<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['productImages', 'store', 'category'])
            ->where('stock_quantity', '>', 0)
            ->where('visibility', true);

        // Filter by category
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by subcategory
        if ($request->has('subcategory')) {
            $query->where('subcategory_id', $request->subcategory);
        }

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('regular_price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('regular_price', '<=', $request->max_price);
        }

        // Sort products
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('regular_price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('regular_price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'popularity':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Search products
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(12);
        $categories = Category::withCount('products')->get();

        return view('frontend.shop', compact('products', 'categories'));
    }

    public function categoryProducts($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)
            ->where('stock_quantity', '>', 0)
            ->where('visibility', true)
            ->with(['productImages', 'store'])
            ->paginate(12);
            
        $categories = Category::withCount('products')->get();
        
        return view('frontend.shop', compact('products', 'categories', 'category'));
    }

    public function subcategoryProducts($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $products = Product::where('subcategory_id', $id)
            ->where('stock_quantity', '>', 0)
            ->where('visibility', true)
            ->with(['productImages', 'store'])
            ->paginate(12);
            
        $categories = Category::withCount('products')->get();
        
        return view('frontend.shop', compact('products', 'categories', 'subcategory'));
    }

    public function productDetails($id)
    {
        $product = Product::with(['productImages', 'store', 'category', 'subcategory'])
            ->where('visibility', true)
            ->findOrFail($id);
            
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock_quantity', '>', 0)
            ->where('visibility', true)
            ->with(['productImages', 'store'])
            ->take(4)
            ->get();
            
        return view('frontend.product-details', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = Product::with(['productImages', 'store'])
            ->where('stock_quantity', '>', 0)
            ->where('visibility', true);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(12);
        
        return view('frontend.shop', compact('products'));
    }
}