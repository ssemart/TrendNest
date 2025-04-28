<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Referral;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;

class CustomerMainController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Gather statistics for dashboard
        $stats = [
            'total_orders' => Order::where('user_id', Auth::id())->count(),
            'active_orders' => Order::where('user_id', Auth::id())
                ->whereIn('order_status', ['pending', 'processing', 'shipped'])
                ->count(),
            'total_spent' => Order::where('user_id', Auth::id())
                ->where('payment_status', 'completed')
                ->sum('total_amount'),
            'wishlist_count' => Wishlist::where('user_id', Auth::id())->count(),
        ];

        // Get recent orders
        $recent_orders = Order::where('user_id', Auth::id())
            ->with('products')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($order) {
                $order->items_count = $order->products->count();
                $order->status_color = $this->getStatusColor($order->order_status);
                return $order;
            });

        return view('customer.dashboard', compact('user', 'stats', 'recent_orders'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        
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

        return redirect()->route('customer.dashboard')->with('success', 'Profile updated successfully');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['products'])
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->through(function($order) {
                $order->status_color = $this->getStatusColor($order->order_status);
                return $order;
            });
            
        return view('customer.history', compact('orders'));
    }

    public function payment()
    {
        $paymentMethods = PaymentMethod::where('user_id', Auth::id())->get();
        return view('customer.payment', compact('paymentMethods'));
    }

    public function storePaymentMethod(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string',
            'expiry' => 'required|string',
            'cvv' => 'required|string',
            'card_holder' => 'required|string'
        ]);

        PaymentMethod::create([
            'user_id' => Auth::id(),
            'card_number' => encrypt($request->card_number),
            'expiry' => $request->expiry,
            'card_holder' => $request->card_holder,
            'type' => 'card'
        ]);

        return redirect()->route('customer.payment')
            ->with('success', 'Payment method added successfully');
    }

    public function deletePaymentMethod($id)
    {
        $method = PaymentMethod::where('user_id', Auth::id())
            ->findOrFail($id);
        $method->delete();

        return redirect()->route('customer.payment')
            ->with('success', 'Payment method removed successfully');
    }

    public function affiliate()
    {
        $stats = (object)[
            'total_referrals' => Referral::where('referrer_id', Auth::id())->count(),
            'active_customers' => Referral::where('referrer_id', Auth::id())
                ->where('status', 'active')
                ->count(),
            'total_earnings' => Referral::where('referrer_id', Auth::id())
                ->where('status', 'completed')
                ->sum('commission')
        ];

        $recentReferrals = Referral::where('referrer_id', Auth::id())
            ->with('customer')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $currentBalance = Referral::where('referrer_id', Auth::id())
            ->where('status', 'completed')
            ->where('paid', false)
            ->sum('commission');

        $nextPayoutDate = Carbon::now()->addMonths(1)->startOfMonth()->format('M d, Y');

        return view('customer.affiliate', compact(
            'stats',
            'recentReferrals',
            'currentBalance',
            'nextPayoutDate'
        ));
    }

    public function cancelOrder($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('id', $id)
            ->whereIn('order_status', ['pending', 'processing'])
            ->firstOrFail();

        $order->update([
            'order_status' => 'cancelled',
            'cancelled_at' => now(),
            'notes' => 'Cancelled by customer'
        ]);

        return redirect()->back()->with('success', 'Order cancelled successfully');
    }

    private function getStatusColor($status)
    {
        return match($status) {
            'completed' => 'success',
            'processing', 'shipped' => 'primary',
            'pending' => 'warning',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }
}
