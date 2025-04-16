<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index(){
        $authuserid = Auth::id();
        $stores = store::where('user_id', $authuserid)->get();
        return view('seller.product.create', compact('stores'));
        
    }

    public function manage(){
        return view('seller.product.manage');
        
    }
}
