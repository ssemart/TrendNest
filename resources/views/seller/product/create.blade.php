@extends('seller.layouts.layout')
@section('Seller_page_title')
Add Product
@endsection

@section('seller_layout')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Add Product</h5>
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
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="product_name" class="fw-bold mb-2">Give Name of Your Product</label>
            <input type="text" class="form-control mb-2" name="product_name" placeholder="Lenovo IdealIpad 5 pro">

            <label for="description" class="fw-bold mb-2">Give Description of Your Product</label>
            <textarea name="description" id="description" class="form-control mb-2" cols="30" rows="10"></textarea>

            <label for="images" class="fw-bold mb-2">Upload Your Product Images</label>
            <input type="file" class="form-control mb-2" name="images[]" multiple>

            <label for="sku " class="fw-bold mb-2">Give Name of Your Product</label>
            <input type="text" class="form-control mb-2" name="sku " placeholder="Lenovo IdealIpad 5 pro">

            <livewire:category-subcategory/>

            <label for="store_id" class="fw-bold mb-2">Select Store Your Store For this Product</label>
            <select name="store_id" id="store_id" class="form-control mb-2">
@foreach($stores as $store)  
<option value="{{ $store->id }}">{{ $store->store_name }}</option>
            @endforeach
            </select>

            <label for="regular_price" class="fw-bold mb-2">Product Regular Price</label>
            <input type="number" class="form-control mb-2" name="regular_price">

            <label for="discounted_price" class="fw-bold mb-2">Discounted Price (If any)</label>
            <input type="number" class="form-control mb-2" name="discounted_price">

            <label for="tax_rate" class="fw-bold mb-2">Give Name of Your Product</label>
            <input type="number" class="form-control mb-2" name="tax_rate">

            <label for="stock_quantity" class="fw-bold mb-2">Stock Quantity</label>
            <input type="text" class="form-control mb-2" name="stock_quantity">

            <label for="slug" class="fw-bold mb-2">Slug</label>
            <input type="text" class="form-control mb-2" name="slug">

            <label for="meta_title" class="fw-bold mb-2">Meta Title</label>
            <input type="text" class="form-control mb-2" name="meta_title">

            <label for="meta_description" class="fw-bold mb-2">Meta Description</label>
            <input type="text" class="form-control mb-2" name="meta_description">

            <button type="submit" class="btn btn-primary w-100 mt-2">Add Category</button>
        </form>
      </div>
    </div>
  </div>
</div>
  

@endsection
