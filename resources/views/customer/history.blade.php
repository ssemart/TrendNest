@extends('customer.layouts.layout')

@section('customer_page_title', 'Order History')

@section('customer_layout')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>Order History</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <strong>#{{ $order->order_number }}</strong>
                                            </td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>{{ $order->products->count() }} items</td>
                                            <td>UGX {{ number_format($order->total_amount) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $order->status_color }}">
                                                    {{ ucfirst($order->order_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $order->payment_status === 'completed' ? 'success' : ($order->payment_status === 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#orderDetail{{ $order->id }}">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Order Details Modal -->
                                        <div class="modal fade" id="orderDetail{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Order #{{ $order->order_number }} Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-4">
                                                            <div class="col-md-6">
                                                                <h6>Order Information</h6>
                                                                <p class="mb-1">Date: {{ $order->created_at->format('M d, Y h:i A') }}</p>
                                                                <p class="mb-1">Status: <span class="badge bg-{{ $order->status_color }}">{{ ucfirst($order->order_status) }}</span></p>
                                                                <p class="mb-1">Payment Status: <span class="badge bg-{{ $order->payment_status === 'completed' ? 'success' : 'warning' }}">{{ ucfirst($order->payment_status) }}</span></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6>Shipping Address</h6>
                                                                <p class="mb-1">{{ $order->shipping_address }}</p>
                                                                <p class="mb-1">{{ $order->shipping_city }}, {{ $order->shipping_country }}</p>
                                                                <p class="mb-1">Phone: {{ $order->shipping_phone }}</p>
                                                            </div>
                                                        </div>

                                                        <h6>Order Items</h6>
                                                        <div class="table-responsive">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product</th>
                                                                        <th>Quantity</th>
                                                                        <th>Price</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($order->products as $product)
                                                                        <tr>
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                                                    <div>
                                                                                        <div class="font-weight-bold">{{ $product->name }}</div>
                                                                                        <div class="small text-muted">{{ $product->sku }}</div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>{{ $product->pivot->quantity }}</td>
                                                                            <td>UGX {{ number_format($product->pivot->price) }}</td>
                                                                            <td>UGX {{ number_format($product->pivot->price * $product->pivot->quantity) }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                                                        <td>UGX {{ number_format($order->subtotal) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3" class="text-end"><strong>Shipping:</strong></td>
                                                                        <td>UGX {{ number_format($order->shipping_cost) }}</td>
                                                                    </tr>
                                                                    @if($order->discount > 0)
                                                                        <tr>
                                                                            <td colspan="3" class="text-end"><strong>Discount:</strong></td>
                                                                            <td>-UGX {{ number_format($order->discount) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                                                        <td><strong>UGX {{ number_format($order->total_amount) }}</strong></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        @if($order->order_status === 'pending' || $order->order_status === 'processing')
                                                            <form action="{{ route('customer.order.cancel', $order->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?')">
                                                                    Cancel Order
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <img src="{{ asset('frontend/img/illustrations/no-orders.svg') }}" alt="No Orders" class="mb-3" style="max-width: 200px;">
                            <h4>No Orders Found</h4>
                            <p class="text-muted">You haven't placed any orders yet.</p>
                            <a href="{{ route('shop') }}" class="btn btn-primary">Start Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
