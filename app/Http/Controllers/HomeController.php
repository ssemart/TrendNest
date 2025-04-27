<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get homepage settings
        $homeSetting = HomePageSetting::first();
        
        // Get featured categories ordered by featured_order
        $featured_categories = Category::where('is_featured', true)
            ->orderBy('featured_order')
            ->take(3)
            ->get();
        
        // Get popular products
        $popular_products = Product::with(['productImages', 'store'])
            ->where('stock_quantity', '>', 0)
            ->where('visibility', true)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
            
        return view('frontend.home', compact('homeSetting', 'featured_categories', 'popular_products'));
    }
    
    public function blog()
    {
        return view('frontend.blog');
    }
    
    public function contact()
    {
        return view('frontend.contact');
    }
    
    public function orderStatus()
    {
        return view('frontend.order-status');
    }
    
    public function paymentOptions()
    {
        return view('frontend.payment-options');
    }
    
    public function shipping()
    {
        return view('frontend.shipping');
    }
    
    public function guides()
    {
        return view('frontend.guides');
    }
    
    public function privacy()
    {
        return view('frontend.privacy');
    }
    
    public function terms()
    {
        return view('frontend.terms');
    }
    
    public function newsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        
        // Process newsletter subscription
        // You can add code here to save to a subscribers table
        
        return redirect()->back()->with('success', 'You have successfully subscribed to our newsletter.');
    }
    
    public function profile()
    {
        return view('frontend.profile');
    }
    
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255'
        ]);
        
        $user->update($request->only(['name', 'email', 'phone', 'address']));
        
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    
    public function orders()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.orders', compact('orders'));
    }
    
    public function orderDetails($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
        return view('frontend.order-details', compact('order'));
    }
    
    public function adminDashboard()
    {
        // Add admin dashboard stats here
        return view('admin.dashboard');
    }
}