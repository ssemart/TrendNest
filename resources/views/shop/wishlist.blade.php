@extends('layouts.frontend')

@section('title', 'My Wishlist - TrendNest')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('frontend/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>My Wishlist</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Wishlist Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if($wishlist->isEmpty())
                        <div class="alert alert-info text-center">
                            <p class="mb-0">Your wishlist is empty.</p>
                            <a href="{{ route('shop') }}" class="btn essence-btn mt-3">Continue Shopping</a>
                        </div>
                    @else
                        <div class="row">
                            @foreach($wishlist as $item)
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="single-product-wrapper">
                                        <!-- Product Image -->
                                        <div class="product-img">
                                            <img src="{{ $item->product->getFirstMediaUrl('product_images') ?? asset('frontend/img/product-img/product-1.jpg') }}" alt="{{ $item->product->product_name }}">
                                        </div>

                                        <!-- Product Description -->
                                        <div class="product-description">
                                            <a href="{{ route('product.details', $item->product->id) }}">
                                                <h6>{{ $item->product->product_name }}</h6>
                                            </a>
                                            <p class="product-price">
                                                @if($item->product->discounted_price)
                                                    <span class="old-price">UGX {{ number_format($item->product->regular_price) }}</span>
                                                    UGX {{ number_format($item->product->discounted_price) }}
                                                @else
                                                    UGX {{ number_format($item->product->regular_price) }}
                                                @endif
                                            </p>

                                            <!-- Hover Content -->
                                            <div class="hover-content">
                                                <div class="add-to-cart-btn">
                                                    <button class="btn essence-btn add-to-cart" data-product-id="{{ $item->product->id }}">Add to Cart</button>
                                                </div>
                                                <div class="remove-from-wishlist mt-2">
                                                    <button class="btn btn-danger remove-wishlist" data-product-id="{{ $item->product->id }}">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Wishlist Area End ##### -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Add to cart functionality
        $('.add-to-cart').on('click', function() {
            const productId = $(this).data('product-id');
            
            $.ajax({
                url: "{{ route('cart.add') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    quantity: 1
                },
                success: function(response) {
                    alert(response.message);
                    $('#cartCount').text(response.cart_count);
                    $('#sideCartCount').text(response.cart_count);
                },
                error: function(error) {
                    alert('Error adding product to cart');
                }
            });
        });

        // Remove from wishlist functionality
        $('.remove-wishlist').on('click', function() {
            const productId = $(this).data('product-id');
            const itemDiv = $(this).closest('.single-product-wrapper');
            
            $.ajax({
                url: "{{ route('wishlist.toggle') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId
                },
                success: function(response) {
                    alert(response.message);
                    itemDiv.fadeOut(function() {
                        $(this).remove();
                        if ($('.single-product-wrapper').length === 0) {
                            location.reload();
                        }
                    });
                },
                error: function(error) {
                    alert('Error removing item from wishlist');
                }
            });
        });
    });
</script>
@endpush