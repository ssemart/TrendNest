@extends('admin.layouts.layout')
@section('admin_page_title')
Admin Settings
@endsection

@section('admin_layout')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Home Page Setting</h5>
                </div>
                <div class="card-body">
@if ($errors->any())
    <div class="alert alert-warning alert-dimissible fade show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
</div>
@endif
                    <form action="" method="POST">
                        @csrf
                        <label for="discounted_product_id" class="fw-bold mb-2">Select Discounted Product</label>
                        <select name="discounted_product_id" id="discounted_product_id" class="form-control">
                            @foreach($products as $product)
<option value="{{$product->id}}" {{$homepagepagesetting->discounted_product_id == $product->id ? 'selected' : ''}}>{{$product->product_name}}</option>
                            @endforeach
                        </select>
                        <label for="discount_percent" class="fw-bold my-2">Discount Percentange</label>
<input type="number" value="{{$homepagepagesetting->discount_percent}}" name="discount_percent" class="form-control">

                        <label for="discount_heading" class="fw-bold my-2">Provide Discount Heading</label>
<input type="text" value="{{$homepagepagesetting->discount_heading}}" name="discount_heading" class="form-control">

                        <label for="discount_subheading" class="fw-bold my-2">Provide Discount Sub Text</label>
<input type="text" value="{{$homepagepagesetting->discount_subheading}}" name="discount_subheading" class="form-control">

                        <label for="featured_1_id" class="fw-bold mb-2">Select Featured Product 1</label>
                        <select name="featured_1_id" id="featured_1_id" class="form-control">
                            @foreach($products as $product)
<option value="{{$product->id}}" {{$homepagepagesetting->featured_1_id == $product->id ? 'selected' : ''}}>{{$product->product_name}}</option>
                            @endforeach
                        </select>

                        <label for="featured_2_id" class="fw-bold mb-2">Select Featured Product 2</label>
                        <select name="featured_2_id" id="featured_2_id" class="form-control">
                            @foreach($products as $product)
<option value="{{$product->id}}" {{$homepagepagesetting->featured_2_id == $product->id ? 'selected' : ''}}>{{$product->product_name}}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary w-100 mt-2">Update Home Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
