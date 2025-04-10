@extends('layouts.dashboardlayout')
@section('title', 'Posts Management')

@section('content')
<div class="card w-100">
    <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Posts Management</h5>
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
            @foreach ($posts as $post)
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
        <div class="mt-3">
            {{ $posts->links() }}
        </div>
        </div>
    </div>
</div>
@endsection