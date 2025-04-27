@extends('admin.layouts.layout')
@section('title', 'Cart History')
@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Cart History</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Cart Activities</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartHistory as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>UGX {{ number_format($item->product->regular_price, 0) }}</td>
                                <td>UGX {{ number_format($item->product->regular_price * $item->quantity, 0) }}</td>
                                <td><span class="badge bg-{{ $item->status == 'completed' ? 'success' : ($item->status == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($item->status) }}</span></td>
                                <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
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
