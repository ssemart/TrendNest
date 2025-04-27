@extends('seller.layouts.layout')

@section('Seller_page_title')
    Vendor Dashboard - TrendNest
@endsection

@section('seller_layout')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>Welcome back, {{ auth()->user()->name }}!</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stores</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $storeCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="align-middle" data-feather="shopping-bag"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $productCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="align-middle" data-feather="package"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Orders Today</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="align-middle" data-feather="shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Today's Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">UGX {{ number_format($todayRevenue ?? 0, 0) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="align-middle" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($orders) && $orders->count() > 0)
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->product->product_name }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>UGX {{ number_format($order->product->discounted_price ?? $order->product->regular_price * $order->quantity, 0) }}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No orders found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('vendor.store.create') }}" class="list-group-item list-group-item-action">
                            <i class="align-middle me-2" data-feather="plus-square"></i> Create New Store
                        </a>
                        <a href="{{ route('vendor.product.create') }}" class="list-group-item list-group-item-action">
                            <i class="align-middle me-2" data-feather="plus"></i> Add New Product
                        </a>
                        <a href="{{ route('vendor.order.history') }}" class="list-group-item list-group-item-action">
                            <i class="align-middle me-2" data-feather="list"></i> View All Orders
                        </a>
                        <a href="{{ route('vendor.profile') }}" class="list-group-item list-group-item-action">
                            <i class="align-middle me-2" data-feather="user"></i> Update Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection