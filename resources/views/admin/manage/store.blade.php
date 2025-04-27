@extends('admin.layouts.layout')
@section('title', 'Manage Stores')
@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Manage Stores</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Stores List</h5>
                    <a href="{{ route('admin.stores.create') }}" class="btn btn-primary">Create Store</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Store Name</th>
                                <th>Owner</th>
                                <th>Slug</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stores as $store)
                            <tr>
                                <td>{{ $store->id }}</td>
                                <td>{{ $store->store_name }}</td>
                                <td>{{ $store->user->name }}</td>
                                <td>{{ $store->slug }}</td>
                                <td>{{ $store->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.stores.delete', $store->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this store?')">Delete</button>
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
@endsection
