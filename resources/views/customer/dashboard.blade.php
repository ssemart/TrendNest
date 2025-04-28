@extends('customer.layouts.layout')

@section('customer_page_title', 'Dashboard')

@section('customer_layout')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>Welcome back, {{ Auth::user()->name }}!</h3>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Total Orders</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $stats['total_orders'] ?? 0 }}</h1>
                    <div class="mb-0">
                        <span class="badge badge-primary-light"> <i class="mdi mdi-arrow-bottom-right"></i> View All Orders </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Active Orders</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="clock"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $stats['active_orders'] ?? 0 }}</h1>
                    <div class="mb-0">
                        <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> In Progress </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Total Spent</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">UGX {{ number_format($stats['total_spent'] ?? 0) }}</h1>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Wishlist Items</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="heart"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $stats['wishlist_count'] ?? 0 }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Recent Orders</h5>
                </div>
                <div class="card-body">
                    @if(isset($recent_orders) && count($recent_orders) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_orders as $order)
                                    <tr>
                                        <td>#{{ $order->order_number }}</td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>{{ $order->items_count }}</td>
                                        <td>UGX {{ number_format($order->total_amount) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status_color }}">
                                                {{ ucfirst($order->order_status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted my-5">No recent orders found</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('customer.order.history') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <i data-feather="shopping-bag" class="me-2"></i>
                                View All Orders
                            </div>
                        </a>
                        <a href="{{ route('customer.setting.payment') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <i data-feather="credit-card" class="me-2"></i>
                                Manage Payment Methods
                            </div>
                        </a>
                        <a href="{{ route('wishlist') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <i data-feather="heart" class="me-2"></i>
                                View Wishlist
                            </div>
                        </a>
                        <a href="{{ route('customer.affiliate') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <i data-feather="users" class="me-2"></i>
                                Affiliate Program
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection