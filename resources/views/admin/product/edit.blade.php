@extends('admin.layouts.layout')

@section('title', 'Edit Product')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Product</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Current Product Images -->
                    @if($product->productImages->count() > 0)
                    <div class="mb-4">
                        <label class="form-label">Current Images</label>
                        <div class="row">
                            @foreach($product->productImages as $image)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $image->img_path) }}" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <form action="{{ route('admin.products.delete-image', $image->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Are you sure you want to delete this image?')">
                                                Remove Image
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku" value="{{ old('sku', $product->sku) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Store</label>
                                <select class="form-select" name="store_id" required>
                                    <option value="">Select Store</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}" {{ old('store_id', $product->store_id) == $store->id ? 'selected' : '' }}>
                                            {{ $store->store_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                @livewire('category-subcategory', [
                                    'selectedCategory' => old('category_id', $product->category_id),
                                    'selectedSubcategory' => old('subcategory_id', $product->subcategory_id)
                                ])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Regular Price</label>
                                <input type="number" step="0.01" class="form-control" name="regular_price" value="{{ old('regular_price', $product->regular_price) }}" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Discounted Price</label>
                                <input type="number" step="0.01" class="form-control" name="discounted_price" value="{{ old('discounted_price', $product->discounted_price) }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tax Rate (%)</label>
                                <input type="number" step="0.01" class="form-control" name="tax_rate" value="{{ old('tax_rate', $product->tax_rate) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Product Images</label>
                                <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                <small class="form-text text-muted">You can select multiple images. Maximum size per image: 2MB</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="visibility" id="visibility" value="1" {{ old('visibility', $product->visibility) ? 'checked' : '' }}>
                                <label class="form-check-label" for="visibility">Make Product Visible</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Product</button>
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection