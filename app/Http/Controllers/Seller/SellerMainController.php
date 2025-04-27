<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Store;
use App\Models\Product;

class SellerMainController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $storeCount = Store::where('user_id', $user->id)->count();
        $productCount = Product::where('seller_id', $user->id)->count();
        
        return view('vendor.dashboard', compact('user', 'storeCount', 'productCount'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('vendor.profile', compact('user'));
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

        return redirect()->route('vendor.profile')->with('success', 'Profile updated successfully');
    }

    public function orderhistory()
    {
        return view('vendor.order.history');
    }
}
