<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with('user')->get();
        return view('admin.manage.store', compact('stores'));
    }

    public function create()
    {
        $users = User::where('role', 'vendor')->get();
        return view('admin.manage.create-store', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255|unique:stores,store_name',
            'user_id' => 'required|exists:users,id',
            'slug' => 'required|string|unique:stores',
            'details' => 'required|string',
        ]);

        Store::create([
            'store_name' => $request->store_name,
            'user_id' => $request->user_id,
            'slug' => Str::slug($request->store_name),
            'details' => $request->details,
        ]);

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store created successfully');
    }

    public function edit(Store $store)
    {
        $users = User::where('role', 'vendor')->get();
        return view('admin.manage.edit-store', compact('store', 'users'));
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'store_name' => 'required|string|max:255|unique:stores,store_name,' . $store->id,
            'user_id' => 'required|exists:users,id',
            'slug' => 'required|string|unique:stores,slug,' . $store->id,
            'details' => 'required|string',
        ]);

        $store->update([
            'store_name' => $request->store_name,
            'user_id' => $request->user_id,
            'slug' => $request->slug,
            'details' => $request->details,
        ]);

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store updated successfully');
    }

    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('admin.stores.index')
            ->with('success', 'Store deleted successfully');
    }
}
