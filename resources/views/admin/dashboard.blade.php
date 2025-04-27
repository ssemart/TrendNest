@extends('admin.layouts.layout')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Dashboard</h1>

    <div class="row">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Sales</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">UGX {{ number_format($totalSales, 0) }}</h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Products</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $totalProducts }}</h1>
                                <div class="mb-0">
                                    <span class="text-danger">
                                        <i class="mdi mdi-arrow-bottom-right"></i> {{ $lowStockProducts }}
                                    </span>
                                    <span class="text-muted">Products Low in Stock</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Customers</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $totalCustomers }}</h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Vendors</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $totalVendors }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Orders</h5>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Products</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $userId => $orders)
                                <tr>
                                    <td>
                                        {{ $orders->first()->user->name ?? 'Guest' }}
                                    </td>
                                    <td>
                                        {{ $orders->count() }} items
                                    </td>
                                    <td>
                                        UGX {{ number_format($orders->sum(function($order) {
                                            return ($order->product->discounted_price ?? $order->product->regular_price) * $order->quantity;
                                        }), 0) }}
                                    </td>
                                    <td>
                                        {{ $orders->first()->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Top Selling Products</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="d-none d-xl-table-cell">Price</th>
                            <th class="d-none d-xl-table-cell">Stock</th>
                            <th>Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topProducts as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td class="d-none d-xl-table-cell">UGX {{ number_format($product->regular_price, 0) }}</td>
                            <td class="d-none d-xl-table-cell">{{ $product->stock_quantity }}</td>
                            <td>{{ $product->total_quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-info">Add New Category</a>
                        <a href="{{ route('admin.subcategories.create') }}" class="btn btn-success">Add New Subcategory</a>
                        <a href="{{ route('admin.products.reviews') }}" class="btn btn-warning">Review Management</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize Feather Icons
    feather.replace();
</script>
@endpush