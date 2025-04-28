@extends('layouts.frontend')

@section('title', 'Checkout - TrendNest')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('frontend/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">
                        <div class="cart-page-heading mb-30">
                            <h5>Billing Address</h5>
                        </div>

                        <form action="{{ route('checkout.process') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First Name <span>*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', auth()->user()->first_name ?? '') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last Name <span>*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', auth()->user()->last_name ?? '') }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="phone">Phone <span>*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="email">Email Address <span>*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="address">Address <span>*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="city">City <span>*</span></label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="zipCode">Zip Code <span>*</span></label>
                                    <input type="text" class="form-control" id="zipCode" name="zip_code" value="{{ old('zip_code') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country">Country <span>*</span></label>
                                    <select class="form-control" id="country" name="country" required>
                                        <option value="UG" selected>Uganda</option>
                                        <option value="KE">Kenya</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="RW">Rwanda</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="order-notes">Order Notes</label>
                                <textarea class="form-control" id="order-notes" name="order_notes" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery.">{{ old('order_notes') }}</textarea>
                            </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">
                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                            <p>The Details</p>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li><span>Product</span> <span>Total</span></li>
                            @foreach($cartItems as $item)
                            <li>
                                <span>{{ $item->product->product_name }} (x{{ $item->quantity }})</span> 
                                <span>UGX {{ number_format(($item->product->discounted_price ?? $item->product->regular_price) * $item->quantity) }}</span>
                            </li>
                            @endforeach
                            <li><span>Subtotal</span> <span>UGX {{ number_format($subtotal) }}</span></li>
                            <li><span>Shipping</span> <span>Free</span></li>
                            <li><span>Total</span> <span>UGX {{ number_format($subtotal) }}</span></li>
                        </ul>

                        <div id="accordion" role="tablist" class="mb-4">
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h6 class="mb-0">
                                        <input type="radio" name="payment_method" value="cod" checked> Cash on Delivery
                                    </h6>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h6 class="mb-0">
                                        <input type="radio" name="payment_method" value="card"> Credit Card
                                        <small>(Coming Soon)</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn essence-btn">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->
@endsection