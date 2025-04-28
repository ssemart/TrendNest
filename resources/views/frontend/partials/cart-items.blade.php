@if(count($cartItems) > 0)
    @foreach($cartItems as $item)
    <div class="single-cart-item" data-cart-id="{{ $item->id }}">
        <a href="{{ route('product.details', $item->product->id) }}" class="product-image">
            <img src="{{ asset($item->product->productImages->first()->image_path ?? 'frontend/img/no-image.png') }}" class="cart-thumb" alt="">
            <div class="cart-item-desc">
                <span class="product-remove" data-cart-id="{{ $item->id }}"><i class="fa fa-close" aria-hidden="true"></i></span>
                <span class="badge">{{ $item->product->store->store_name }}</span>
                <h6>{{ $item->product->product_name }}</h6>
                <p class="quantity">Quantity: <span>{{ $item->quantity }}</span></p>
                <p class="price">UGX {{ number_format(($item->product->discounted_price ?? $item->product->regular_price) * $item->quantity) }}</p>
            </div>
        </a>
    </div>
    @endforeach
@else
    <div class="text-center p-4">
        <p>Your cart is empty</p>
        <a href="{{ route('shop') }}" class="btn essence-btn">Continue Shopping</a>
    </div>
@endif