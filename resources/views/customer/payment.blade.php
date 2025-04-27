@extends('customer.layouts.layout')

@section('customer_layout')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto">
            <h3>Payment Methods</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Saved Payment Methods</h5>
                </div>
                <div class="card-body">
                    @if(isset($paymentMethods) && count($paymentMethods) > 0)
                        @foreach($paymentMethods as $method)
                        <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    @if($method->type == 'card')
                                        <i class="fa fa-credit-card fa-2x"></i>
                                    @else
                                        <i class="fa fa-university fa-2x"></i>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-1">{{ $method->name }}</h6>
                                    <small class="text-muted">Expires: {{ $method->expiry }}</small>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-3">
                            <p>No payment methods saved yet.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Add New Payment Method</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.payment.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Card Number</label>
                            <input type="text" class="form-control" name="card_number" placeholder="**** **** **** ****">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Expiry Date</label>
                                    <input type="text" class="form-control" name="expiry" placeholder="MM/YY">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">CVV</label>
                                    <input type="text" class="form-control" name="cvv" placeholder="***">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Card Holder Name</label>
                            <input type="text" class="form-control" name="card_holder" placeholder="Name on card">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Payment Method</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Payment Security</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-lock me-2"></i>
                        <span>Your payment information is encrypted</span>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-shield-alt me-2"></i>
                        <span>Protected by SSL certification</span>
                    </div>
                    <div>
                        <i class="fas fa-user-shield me-2"></i>
                        <span>Your data is never shared with merchants</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
