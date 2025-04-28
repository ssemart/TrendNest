@extends('layouts.frontend')

@section('title', $product->product_name.' - TrendNest')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('frontend/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Product Details</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">
        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                @foreach($product->productImages as $image)
                    <img src="{{ asset('storage/'.$image->img_path) }}" alt="{{ $product->product_name }}">
                @endforeach
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>{{ $product->store->store_name ?? 'TrendNest' }}</span>
            <h2>{{ $product->product_name }}</h2>
            <p class="product-price">
                @if($product->discounted_price && $product->discounted_price < $product->regular_price)
                    <span class="old-price">UGX {{ number_format($product->regular_price) }}</span>
                    UGX {{ number_format($product->discounted_price) }}
                @else
                    UGX {{ number_format($product->regular_price) }}
                @endif
            </p>
            <p class="product-desc">{{ $product->description }}</p>

            <!-- Form -->
            <form class="cart-form clearfix" action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <!-- Select Box -->
                <div class="quantity">
                    <span>Quantity:</span>
                    <div class="pro-qty">
                        <input type="number" class="form-control" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}">
                    </div>
                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <button type="submit" class="btn essence-btn">Add to Cart</button>
                    <!-- Favourite -->
                    <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart" data-product-id="{{ $product->id }}"></a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize product image slider
        $('.product_thumbnail_slides').owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1000
        });

        // Handle wishlist toggle
        $('.favme').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            
            $.ajax({
                url: '{{ route("wishlist.toggle") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    if (response.message) {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        window.location.href = '{{ route("login") }}';
                    }
                }
            });
        });
    });
</script>
@endpush