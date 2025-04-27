@extends('admin.layouts.layout')
@section('title', 'Create Store')
@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Create New Store</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Store Details</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.stores.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="store_name" class="form-label">Store Name</label>
                            <input type="text" class="form-control @error('store_name') is-invalid @enderror" 
                                id="store_name" name="store_name" value="{{ old('store_name') }}" required>
                            @error('store_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                id="slug" name="slug" value="{{ old('slug') }}" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="details" class="form-label">Store Details</label>
                            <textarea class="form-control @error('details') is-invalid @enderror" 
                                id="details" name="details" rows="3" required>{{ old('details') }}</textarea>
                            @error('details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Store Owner</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" 
                                id="user_id" name="user_id" required>
                                <option value="">Select Owner</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Store</button>
                        <a href="{{ route('admin.stores.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('store_name').addEventListener('input', function(e) {
    let slug = e.target.value
        .toLowerCase()
        .replace(/[^\w ]+/g, '')
        .replace(/ +/g, '-');
    document.getElementById('slug').value = slug;
});
</script>
@endpush
