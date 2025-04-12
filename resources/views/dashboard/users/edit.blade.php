@extends('layouts.dashboardlayout')
@section('title', 'Edit User')

@section('content')
<h5 class="card-title fw-semibold mb-4 text-light">Edit User #{{ $user->id }}</h5>
<div class="card">
    <div class="card-body">
        <form action="{{ route('dashboard.users.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="username" class="form-label text-white">Name</label>
                <input type="text" class="form-control text-white" name="name" id="name" value="{{ old('name', $user->name) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-white">Email address</label>
                <input type="email" class="form-control text-white" name="email" id="email" value="{{ old('email', $user->email) }}">
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label text-white">Role</label>
                <select name="role" class="form-control text-dark">
                    <option value="">** Select Role **</option>
                    <option value="is_author" {{ $user->is_author ? 'selected' : '' }}>Author</option>
                    <option value="is_admin" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@endsection
