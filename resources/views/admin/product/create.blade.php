@extends('admin.layouts.layout')

@section('title', 'Create Product')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Create New Product</h5>
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

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku" value="{{ old('sku') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="4">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Store</label>
                                <select class="form-select" name="store_id" required>
                                    <option value="">Select Store</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                            {{ $store->store_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                @livewire('category-subcategory')
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Regular Price</label>
                                <input type="number" step="0.01" class="form-control" name="regular_price" value="{{ old('regular_price') }}" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Discounted Price</label>
                                <input type="number" step="0.01" class="form-control" name="discounted_price" value="{{ old('discounted_price') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tax Rate (%)</label>
                                <input type="number" step="0.01" class="form-control" name="tax_rate" value="{{ old('tax_rate', 0) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Product Images</label>
                                <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                <small class="form-text text-muted">You can select multiple images. Maximum size per image: 2MB</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Description</label>
                                <textarea class="form-control" name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="visibility" id="visibility" value="1" {{ old('visibility') ? 'checked' : '' }}>
                                <label class="form-check-label" for="visibility">Make Product Visible</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Product</button>
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection