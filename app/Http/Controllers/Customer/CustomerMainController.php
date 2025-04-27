<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Referral;
use Carbon\Carbon;

class CustomerMainController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('customer.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
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
        $orders = Order::where('user_id', auth()->id())
            ->with(['products'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('customer.history', compact('orders'));
    }

    public function payment()
    {
        $paymentMethods = PaymentMethod::where('user_id', auth()->id())->get();
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
            'user_id' => auth()->id(),
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
        $method = PaymentMethod::where('user_id', auth()->id())
            ->findOrFail($id);
        $method->delete();

        return redirect()->route('customer.payment')
            ->with('success', 'Payment method removed successfully');
    }

    public function affiliate()
    {
        $stats = (object)[
            'total_referrals' => Referral::where('referrer_id', auth()->id())->count(),
            'active_customers' => Referral::where('referrer_id', auth()->id())
                ->where('status', 'active')
                ->count(),
            'total_earnings' => Referral::where('referrer_id', auth()->id())
                ->where('status', 'completed')
                ->sum('commission')
        ];

        $recentReferrals = Referral::where('referrer_id', auth()->id())
            ->with('customer')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $currentBalance = Referral::where('referrer_id', auth()->id())
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
}
