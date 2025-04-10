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
                    <h6 class="fw-semibold mb-0">Actions</h6>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($comments as $comment)
            <tr>
                <td class="border-bottom-0">
                    <h5 class="fw-semibold mb-0">{{$comment->id}}</h5>
                </td>
                <td class="border-bottom-0">
                    <h5 class="fw-semibold mb-0">{{$comment->content}}</h5>
                </td>
                <td class="border-bottom-0">
                    <h5 class="fw-semibold mb-0">{{$comment->user->name}}</>
                </td>
                <td class="border-bottom-0">
                    <h5 class="fw-semibold mb-0">#{{$comment->post->id}}</h5>
                </td>
                <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{route('comments.edit', $comment->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>    
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