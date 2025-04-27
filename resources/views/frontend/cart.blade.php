@extends('layouts.frontend')

@section('title', 'Shopping Cart - TrendNest')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('frontend/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shopping Cart Area Start ##### -->
    <div class="cart_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if($cartItems->count() > 0)
                    <div class="cart-table clearfix">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr data-cart-id="{{ $item->id }}">
                                    <td class="cart_product_img d-flex align-items-center">
                                        <a href="{{ route('product.details', $item->product->id) }}">
                                            <img src="{{ $item->product->productImages->first() ? asset('storage/'.$item->product->productImages->first()->image_path) : asset('frontend/img/product-img/product-1.jpg') }}" 
                                                 alt="{{ $item->product->product_name }}">
                                        </a>
                                        <h6>{{ $item->product->product_name }}</h6>
                                    </td>
                                    <td class="price">
                                        <span>UGX {{ number_format($item->product->discounted_price ?? $item->product->regular_price, 0) }}</span>
                                    </td>
                                    <td class="qty">
                                        <div class="quantity">
                                            <input type="number" 
                                                   class="qty-text" 
                                                   step="1" 
                                                   min="1" 
                                                   max="{{ $item->product->stock_quantity }}" 
                                                   name="quantity" 
                                                   value="{{ $item->quantity }}"
                                                   data-cart-id="{{ $item->id }}">
                                        </div>
                                    </td>
                                    <td class="total_price">
                                        <span>UGX {{ number_format(($item->product->discounted_price ?? $item->product->regular_price) * $item->quantity, 0) }}</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn essence-btn btn-sm remove-from-cart" data-cart-id="{{ $item->id }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <!-- Cart Summary -->
                        <div class="col-12 col-lg-4 offset-lg-8">
                            <div class="cart-summary">
                                <h5>Cart Total</h5>
                                <ul class="summary-table">
                                    <li><span>subtotal:</span> <span>UGX {{ number_format($cartTotal, 0) }}</span></li>
                                    <li><span>delivery:</span> <span>Free</span></li>
                                    <li><span>total:</span> <span>UGX {{ number_format($cartTotal, 0) }}</span></li>
                                </ul>
                                <div class="checkout-btn mt-100">
                                    <a href="{{ route('checkout') }}" class="btn essence-btn">check out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center">
                        <h4>Your cart is empty</h4>
                        <a href="{{ route('shop') }}" class="btn essence-btn mt-4">Continue Shopping</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Shopping Cart Area End ##### -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Update cart quantity
        $('.qty-text').on('change', function() {
            const cartId = $(this).data('cart-id');
            const quantity = $(this).val();
            const row = $(`tr[data-cart-id="${cartId}"]`);
            
            $.ajax({
                url: "{{ route('cart.update') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_id: cartId,
                    quantity: quantity
                },
                success: function(response) {
                    // Update the total price for this item
                    row.find('.total_price span').text('UGX ' + response.new_subtotal);
                    
                    // Reload the page to update all totals
                    location.reload();
                },
                error: function(error) {
                    alert(error.responseJSON.message || 'Error updating cart');
                    location.reload();
                }
            });
        });

        // Remove item from cart
        $('.remove-from-cart').on('click', function(e) {
            e.preventDefault();
            const cartId = $(this).data('cart-id');
            const row = $(`tr[data-cart-id="${cartId}"]`);
            
            if (confirm('Are you sure you want to remove this item?')) {
                $.ajax({
                    url: "{{ route('cart.remove') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        cart_id: cartId
                    },
                    success: function(response) {
                        row.fadeOut(function() {
                            $(this).remove();
                            $('#cartCount').text(response.cart_count);
                            $('#sideCartCount').text(response.cart_count);
                            
                            // Reload the page if cart is empty
                            if (response.cart_count === 0) {
                                location.reload();
                            }
                        });
                    },
                    error: function(error) {
                        alert('Error removing item from cart');
                    }
                });
            }
        });
    });
</script>
@endpush