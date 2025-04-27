@extends('admin.layouts.layout')

@section('title', 'Create Subcategory')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Create New Subcategory</h5>
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

                    <form action="{{ route('admin.subcategories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Parent Category</label>
                            <select class="form-select" name="category_id" required>
                                <option value="">Select Parent Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subcategory Name</label>
                            <input type="text" class="form-control" name="subcategory_name" value="{{ old('subcategory_name') }}" required>
                            <small class="form-text text-muted">Subcategory name must be between 5 and 100 characters.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Subcategory</button>
                        <a href="{{ route('admin.subcategories') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
