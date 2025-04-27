@extends('layouts.frontend')

@section('title', 'TrendNest - Home')

@section('content')
    <!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url({{ asset('frontend/img/bg-img/bg-1.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h6>{{ $homeSetting->small_text ?? 'New Collection' }}</h6>
                        <h2>{{ $homeSetting->big_text ?? 'Winter Collection' }}</h2>
                        <a href="{{ route('shop') }}" class="btn essence-btn">view collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Top Categories Area Start ##### -->
    <section class="top_catagory_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Shop By Category</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Single Catagory -->
                @foreach($featured_categories as $category)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url({{ $category->image_path ? asset('storage/' . $category->image_path) : asset('frontend/img/bg-img/bg-2.jpg') }});">
                        <div class="catagory-content">
                            <a href="{{ route('shop.category', $category->id) }}">{{ $category->category_name }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ##### Top Categories Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content bg-img background-overlay" style="background-image: url({{ asset('frontend/img/bg-img/bg-5.jpg') }});">
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <div class="cta--text">
                                <h6>{{ $homeSetting->discount_label ?? '-60%' }}</h6>
                                <h2>{{ $homeSetting->sale_title ?? 'Global Sale' }}</h2>
                                <a href="{{ route('shop') }}" class="btn essence-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>{{ $homeSetting->product_section_title ?? 'Popular Products' }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">
                        @foreach($popular_products as $product)
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                @php 
                                    $image = $product->productImages->first() ? asset('storage/'.$product->productImages->first()->img_path) : asset('frontend/img/product-img/product-1.jpg'); 
                                    $hoverImage = $product->productImages->count() > 1 ? asset('storage/'.$product->productImages[1]->img_path) : $image;
                                @endphp
                                <img src="{{ $image }}" alt="{{ $product->product_name }}">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="{{ $hoverImage }}" alt="{{ $product->product_name }}">

                                @if($product->discounted_price && $product->discounted_price < $product->regular_price)
                                <!-- Product Badge -->
                                <div class="product-badge offer-badge">
                                    <span>-{{ round((($product->regular_price - $product->discounted_price) / $product->regular_price) * 100) }}%</span>
                                </div>
                                @endif

                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart" data-product-id="{{ $product->id }}"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span>{{ $product->store->store_name ?? 'TrendNest' }}</span>
                                <a href="{{ route('product.details', $product->id) }}">
                                    <h6>{{ $product->product_name }}</h6>
                                </a>
                                @if($product->discounted_price && $product->discounted_price < $product->regular_price)
                                <p class="product-price"><span class="old-price">UGX {{ number_format($product->regular_price, 0) }}</span> UGX {{ number_format($product->discounted_price, 0) }}</p>
                                @else
                                <p class="product-price">UGX {{ number_format($product->regular_price, 0) }}</p>
                                @endif

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="#" class="btn essence-btn add-to-cart" data-product-id="{{ $product->id }}">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### New Arrivals Area End ##### -->

    <!-- ##### Brands Area Start ##### -->
    <div class="brands-area d-flex align-items-center justify-content-between">
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('frontend/img/core-img/brand1.png') }}" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('frontend/img/core-img/brand2.png') }}" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('frontend/img/core-img/brand3.png') }}" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('frontend/img/core-img/brand4.png') }}" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('frontend/img/core-img/brand5.png') }}" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('frontend/img/core-img/brand6.png') }}" alt="">
        </div>
    </div>
    <!-- ##### Brands Area End ##### -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Add to cart functionality
        $('.add-to-cart').on('click', function(e) {
            e.preventDefault();
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
                    // Update cart items if needed
                },
                error: function(error) {
                    alert('Error adding product to cart');
                }
            });
        });

        // Wishlist functionality
        $('.product-favourite .favme').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            
            $.ajax({
                url: "{{ route('wishlist.toggle') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(error) {
                    alert('Error updating wishlist');
                }
            });
        });
    });
</script>
@endpush