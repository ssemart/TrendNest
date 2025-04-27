<div class="shop_grid_product_area">
    <div class="row">
        <div class="col-12">
            <div class="product-topbar d-flex align-items-center justify-content-between mb-4">
                <!-- Search Products -->
                <div class="search-products">
                    <input type="text" 
                           wire:model.live="search" 
                           class="form-control" 
                           placeholder="Search products...">
                </div>

                <!-- Sorting Products -->
                <div class="product-sorting d-flex">
                    <select wire:model.live="sortBy" class="form-control">
                        <option value="newest">Newest First</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="popularity">Most Popular</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar with Filters -->
        <div class="col-12 col-md-4 col-lg-3">
            <div class="shop_sidebar_area">
                <!-- Categories Filter -->
                <div class="widget catagory mb-50">
                    <h6 class="widget-title mb-30">Categories</h6>
                    <div class="catagories-menu">
                        <ul class="menu-content">
                            <li>
                                <a href="#" 
                                   wire:click.prevent="$set('selectedCategory', null)"
                                   class="{{ is_null($selectedCategory) ? 'active' : '' }}">
                                    All Categories
                                </a>
                            </li>
                            @foreach($categories as $category)
                            <li>
                                <a href="#" 
                                   wire:click.prevent="$set('selectedCategory', {{ $category->id }})"
                                   class="{{ $selectedCategory == $category->id ? 'active' : '' }}">
                                    {{ $category->category_name }}
                                    <span class="badge">{{ $category->products_count }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="widget price mb-50">
                    <h6 class="widget-title mb-30">Filter by Price</h6>
                    <div class="widget-desc">
                        <div class="range-slider">
                            <input type="number" 
                                   wire:model.live="minPrice" 
                                   class="form-control mb-2" 
                                   placeholder="Min Price">
                            <input type="number" 
                                   wire:model.live="maxPrice" 
                                   class="form-control mb-2" 
                                   placeholder="Max Price">
                        </div>
                    </div>
                </div>

                <!-- Reset Filters -->
                <div class="widget mb-50">
                    <button wire:click="resetFilters" class="btn essence-btn w-100">
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-12 col-md-8 col-lg-9">
            <div class="row">
                @forelse($products as $product)
                <!-- Single Product -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            @php 
                                $image = $product->productImages->first() ? asset('storage/'.$product->productImages->first()->image_path) : asset('frontend/img/product-img/product-1.jpg');
                                $hoverImage = $product->productImages->count() > 1 ? asset('storage/'.$product->productImages[1]->image_path) : $image;
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
                                    <a href="#" class="btn essence-btn add-to-cart" data-product-id="{{ $product->id }}">
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No products found matching your criteria.
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-5">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>