@extends('admin.layouts.layout')
@section('title', 'Order History')
@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Order History</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Orders</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total Amount</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->items_count }} items</td>
                                <td>UGX {{ number_format($order->total_amount, 0) }}</td>
                                <td><span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">{{ ucfirst($order->payment_status) }}</span></td>
                                <td>
                                    <span class="badge bg-{{ 
                                        $order->status == 'completed' ? 'success' : 
                                        ($order->status == 'processing' ? 'primary' : 
                                        ($order->status == 'cancelled' ? 'danger' : 'warning')) 
                                    }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info">View</button>
                                    <button class="btn btn-sm btn-warning">Update Status</button>
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
@endsection
