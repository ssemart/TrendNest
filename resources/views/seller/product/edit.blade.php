@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="fw-bold mb-2">Product Name</label>
            <input type="text" class="form-control mb-2" name="name" value="{{ $product->name }}">
        </div>

        <div class="mb-3">
            <label for="price" class="fw-bold mb-2">Price</label>
            <input type="number" class="form-control mb-2" name="price" value="{{ $product->price }}">
        </div>

        <div class="mb-3">
            <label for="description" class="fw-bold mb-2">Description</label>
            <textarea class="form-control mb-2" name="description">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="meta_description" class="fw-bold mb-2">Meta Description</label>
            <input type="text" class="form-control mb-2" name="meta_description" value="{{ $product->meta_description }}">
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="visibility" id="visibility" value="1" {{ old('visibility', $product->visibility) ? 'checked' : '' }}>
                <label class="form-check-label" for="visibility">Make Product Visible</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-2">Update Product</button>
    </form>
</div>
@endsection