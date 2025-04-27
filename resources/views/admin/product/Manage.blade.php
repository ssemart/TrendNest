@extends('admin.layouts.layout')

@section('title', 'Manage Products')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Manage Products</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Category</th>
                                    <th>Store</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Visible</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @php
                                                $imagePath = $product->productImages->first() ? $product->productImages->first()->img_path : null;
                                                $imageUrl = $imagePath && file_exists(public_path('storage/'.$imagePath)) 
                                                    ? asset('storage/'.$imagePath) 
                                                    : asset('frontend/img/product-img/product-1.jpg');
                                            @endphp
                                            <img src="{{ $imageUrl }}" 
                                                 alt="{{ $product->product_name }}" 
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->category->category_name }}</td>
                                        <td>{{ $product->store->store_name }}</td>
                                        <td>
                                            @if($product->discounted_price)
                                                <span class="text-decoration-line-through text-muted">UGX {{ number_format($product->regular_price, 0) }}</span>
                                                <br>
                                                <span class="text-danger">UGX {{ number_format($product->discounted_price, 0) }}</span>
                                            @else
                                                UGX {{ number_format($product->regular_price, 0) }}
                                            @endif
                                        </td>
                                        <td>{{ $product->stock_quantity }}</td>
                                        <td>
                                            <span class="badge {{ $product->visibility ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $product->visibility ? 'Yes' : 'No' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
