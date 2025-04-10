@extends('layouts.dashboardlayout')
@section('title', 'Premium Overview')

@section('content')
    <div class="row gap-3 px-3">
        <div class="card col">
            <div class="card-body">
                <div class="row align-items-start">
                    <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold">Premium Users</h5>
                        <h4 class="fw-semibold mb-3">{{$premiumUsers->count()}}</h4>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end">
                            <div
                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="engagement"></div>
        </div>
        <div class="card col">
            <div class="card-body">
                <div class="row align-items-start">
                    <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold">Premium Posts</h5>
                        <h4 class="fw-semibold mb-3">{{$premiumPosts->count()}}</h4>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end">
                            <div
                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="engagement"></div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Premium Users</h5>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Role</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Actions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($premiumUsers as $user)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $user->id }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $user->name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $user->email }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">
                                        @if ($user->is_admin)
                                            <span class="badge bg-success">Admin</span>
                                        @else
                                            <span class="badge bg-primary">User</span>
                                        @endif
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">
                                        @if ($user->is_banned)
                                            <span class="badge bg-danger">Banned</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Premium Posts</h5>
            <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                <tr>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Id</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Image</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Title</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Author</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Views</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Created At</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Actions</h6>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($premiumPosts as $post)
                    <tr>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">{{$post->id}}</h6>
                        </td>
                        <td class="border-bottom-0">
                            <img src="{{$post->featured_image}}" alt="image" class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">
                                <a href="/posts/{{$post->slug}}">{{$post->title}}</a>
                            </h6>
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">{{$post->user->name}}</h6>
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">{{$post->getViewCount()}}</h6>
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">{{$post->created_at->diffForHumans()}}</h6>
                        </td>
                        <td class="border-bottom-0">
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{route('posts.edit', $post->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
