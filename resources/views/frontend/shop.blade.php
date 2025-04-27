@extends('layouts.frontend')

@section('title', isset($category) ? $category->category_name . ' - Shop' : 'Shop - TrendNest')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('frontend/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>{{ isset($category) ? $category->category_name : 'Shop' }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Categories</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content">
                                    @foreach($categories as $cat)
                                    <li>
                                        <a href="{{ route('shop.category', $cat->id) }}" class="{{ isset($category) && $category->id == $cat->id ? 'active' : '' }}">
                                            {{ $cat->category_name }}
                                            <span class="badge">{{ $cat->products_count }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Filter by Price</h6>

                            <div class="widget-desc">
                                <form action="{{ route('shop') }}" method="GET">
                                    @if(request()->has('category'))
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                    @endif
                                    @if(request()->has('search'))
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    
                                    <div class="range-slider">
                                        <input type="number" name="min_price" placeholder="Min" min="0" value="{{ request('min_price') }}" class="form-control mb-2">
                                        <input type="number" name="max_price" placeholder="Max" min="0" value="{{ request('max_price') }}" class="form-control mb-2">
                                    </div>
                                    <button type="submit" class="btn essence-btn btn-sm">Filter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p>Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }}</p>
                                    </div>
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <form action="{{ route('shop') }}" method="GET">
                                            @if(request()->has('category'))
                                                <input type="hidden" name="category" value="{{ request('category') }}">
                                            @endif
                                            @if(request()->has('search'))
                                                <input type="hidden" name="search" value="{{ request('search') }}">
                                            @endif
                                            
                                            <select name="sort" class="form-control" onchange="this.form.submit()">
                                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                                <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @forelse($products as $product)
                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        @php 
                                            $imagePath = $product->productImages->first() ? $product->productImages->first()->img_path : null;
                                            $image = $imagePath ? (file_exists(public_path('storage/'.$imagePath)) ? asset('storage/'.$imagePath) : asset('frontend/img/product-img/product-1.jpg')) : asset('frontend/img/product-img/product-1.jpg');
                                            
                                            $secondImagePath = $product->productImages->count() > 1 ? $product->productImages[1]->img_path : null;
                                            $hoverImage = $secondImagePath ? (file_exists(public_path('storage/'.$secondImagePath)) ? asset('storage/'.$secondImagePath) : $image) : $image;
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
                                            <p class="product-price">
                                                <span class="old-price">UGX {{ number_format($product->regular_price, 0) }}</span> 
                                                UGX {{ number_format($product->discounted_price, 0) }}
                                            </p>
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
                            </div>
                            @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    No products found.
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-5">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->
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