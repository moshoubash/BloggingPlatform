@extends('layouts.dashboardlayout')
@section('title', 'Account Settings')

@section('content')
<h5 class="card-title fw-semibold mb-4 text-light">Profile Settings</h5>
<div class="card">
    <div class="card-body">
        <form action="{{ route('dashboard.users.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label text-white">Name</label>
                <input type="text" class="form-control text-white" name="name" id="name" value="{{ old('name', Auth::user()->name) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-white">Email address</label>
                <input type="email" class="form-control text-white" name="email" id="email" value="{{ old('email', Auth::user()->email) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</div>
@endsection