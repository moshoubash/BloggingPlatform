@extends('layouts.dashboardlayout')
@section('title', 'Comments Management')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Comments Management</h5>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Comment</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">User</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Post</h6>
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
                        @foreach ($comments->sortByDesc('created_at') as $comment)
                            <tr>
                                <td class="border-bottom-0">
                                    <h5 class="fw-semibold mb-0">{{ $comment->id }}</h5>
                                </td>
                                <td class="border-bottom-0">
                                    <h5 class="fw-semibold mb-0">{{ $comment->content }}</h5>
                                </td>
                                <td class="border-bottom-0">
                                    <h5 class="fw-semibold mb-0">{{ $comment->user->name }}</>
                                </td>
                                <td class="border-bottom-0">
                                    <h5 class="fw-semibold mb-0">#{{ $comment->post_id }}</h5>
                                </td>
                                <td class="border-bottom-0">
                                    <h5 class="fw-semibold mb-0">{{ $comment->created_at->diffForHumans() }}</>
                                </td>
                                <td class="border-bottom-0">
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $comment->id }}">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $comment->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close bg-light"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this comment?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('dashboard.comments.destroy', $comment->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
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
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
