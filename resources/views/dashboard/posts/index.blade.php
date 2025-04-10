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
            @foreach ($posts->sortByDesc('created_at') as $post)
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
                            <a href="{{route('dashboard.posts.edit', $post->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $post->id }}">
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                            <button type="button" class="btn-close bg-light"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this post?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('dashboard.posts.destroy', $post->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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