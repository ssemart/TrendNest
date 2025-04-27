<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Cart;
use App\Models\Store;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminMainController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        // Get total sales
        $totalSales = Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->select(DB::raw('SUM(products.regular_price * carts.quantity) as total'))
            ->first()->total ?? 0;

        // Get recent orders
        $recentOrders = Cart::with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->groupBy('user_id');

        // Get product stats
        $totalProducts = Product::count();
        $lowStockProducts = Product::where('stock_quantity', '<', 10)->count();

        // Get user stats
        $totalCustomers = User::where('role', 'customer')->count();
        $totalVendors = User::where('role', 'vendor')->count();

        // Get category stats
        $totalCategories = Category::count();
        $totalStores = Store::count();

        // Get top selling products
        $topProducts = Product::withCount(['carts as total_quantity' => function($query) {
                $query->select(DB::raw('SUM(quantity)'));
            }])
            ->orderBy('total_quantity', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalSales',
            'recentOrders',
            'totalProducts',
            'lowStockProducts',
            'totalCustomers',
            'totalVendors',
            'totalCategories',
            'totalStores',
            'topProducts'
        ));
    }

    public function setting(){
        $products = Product::all();
        $homepagepagesetting = HomePageSetting::first() ?? new HomePageSetting();
        return view('admin.settings', compact('products', 'homepagepagesetting'));
    }

    public function manage_user()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.manage.user', compact('users'));
    }

    public function view_user($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manage.view-user', compact('user'));
    }

    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manage.edit-user', compact('user'));
    }

    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role' => 'required|in:0,1,2',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:8|confirmed',
            ]);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.manage.user')->with('success', 'User updated successfully');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.manage.user')->with('success', 'User deleted successfully');
    }

    public function manage_stores()
    {
        $stores = Store::with('user')->get();
        return view('admin.manage.store', compact('stores'));
    }

    public function cart_history(){
        $cartHistory = Cart::with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.cart.history', compact('cartHistory'));
    }

    public function order_history(){
        $orders = Cart::with('user')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.user_id', 
                DB::raw('COUNT(*) as items_count'), 
                DB::raw('SUM(carts.quantity * products.regular_price) as total_amount'), 
                'carts.status', 
                'carts.payment_status', 
                'carts.created_at')
            ->groupBy('user_id', 'created_at', 'status', 'payment_status')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.order.history', compact('orders'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name', 'email']);

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                $this->deleteFile($user->profile_picture);
            }
            
            // Upload new profile picture
            $data['profile_picture'] = $this->uploadFile(
                $request->file('profile_picture'),
                'profile-pictures'
            );
        }

        $user->update($data);

        if ($request->filled('new_password')) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
        }

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
    }
}