<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class SellerStoreController extends Controller
{
    public function index(){
        return view('seller.store.create');
        
    }

    public function manage(){
        $userid = Auth::user()->id;
        $stores = Store::where('user_id', $userid)->get();
        return view('seller.store.manage', compact('stores'));
        
    }

    public function orderhistory(){
        return view('seller.orderhistory');
        
    }

    public function store(Request $request){
        $validate_data = $request->validate([
            'store_name' => 'unique:stores|max:100|min:3',
            'slug' =>'required|unique:stores',
            'details'=>'required',
        ]);

        Store::create([
            'store_name' => $request->store_name,
            'slug' => $request->slug,
            'details' => $request->details,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('message', 'Store created successfully');
       

    }

    public function showsstore($id){
        $store = Store::findOrFail($id);
        return view('seller.store.edit', compact('store'));
    }
    
    public function updatestore(Request $request, $id){
        $store = Store::findOrFail($id);
        $validate_data = $request->validate([
            'store_name' => 'required|max:100|min:3|unique:stores,store_name,'.$id,
            'slug' => 'required|unique:stores,slug,'.$id,
            'details' => 'required'
        ]);
    
        $store->update($validate_data);
        return redirect()->route('vendor.store.manage')->with('message', 'Store updated successfully');
    }
    
    public function deletestore($id){
        Store::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'Store deleted successfully');
    }
}
