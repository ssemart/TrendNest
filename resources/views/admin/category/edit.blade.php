@extends('admin.layouts.layout')

@section('title', 'Edit Category')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Category</h5>
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

                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name" value="{{ old('category_name', $category->category_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="category_image" class="form-label">Category Image</label>
                            @if($category->image_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->category_name }}" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control" id="category_image" name="category_image" accept="image/*">
                            <small class="form-text text-muted">Leave empty to keep current image. Recommended size: 800x600 pixels</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $category->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Show on Homepage</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="featured_order" class="form-label">Display Order on Homepage</label>
                            <input type="number" class="form-control" id="featured_order" name="featured_order" value="{{ old('featured_order', $category->featured_order) }}" min="0">
                            <small class="form-text text-muted">Lower numbers will be displayed first. Only applies if "Show on Homepage" is checked.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Category</button>
                        <a href="{{ route('admin.categories') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
