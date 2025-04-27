<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Cart;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
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
}