@extends('admin.layouts.layout')
@section('title', 'View User')
@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">User Details</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">User Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <p><span class="badge bg-{{ $user->role == 0 ? 'primary' : ($user->role == 1 ? 'success' : 'secondary') }}">
                            {{ $user->role == 0 ? 'Admin' : ($user->role == 1 ? 'Vendor' : 'Customer') }}
                        </span></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Created At</label>
                        <p>{{ $user->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>

                    <a href="{{ route('admin.manage.user') }}" class="btn btn-secondary">Back to Users List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection