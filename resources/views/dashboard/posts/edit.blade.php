@extends('layouts.dashboardlayout')
@section('title', 'Edit Post')

@section('content')
<h5 class="card-title fw-semibold mb-4 text-light">Edit Post #{{ $post->id }}</h5>
<div class="card">
    <div class="card-body">
        <form action="{{ route('dashboard.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label text-white">Title</label>
                <input type="text" class="form-control text-white" name="title" id="title" value="{{ old('title', $post->title) }}">
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label text-white">Slug</label>
                <input type="text" class="form-control text-white" name="slug" id="slug" value="{{ old('slug', $post->slug) }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-white">Description</label>
                <textarea name="description" id="description" class="form-control text-white" rows="2">{{ old('description', $post->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="body" class="form-label text-white">Body</label>
                <textarea name="body" id="body" class="form-control text-white" rows="6">{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label text-white">Status</label>
                <select name="status" id="status" class="form-control text-dark">
                    <option value="draft" {{ $post->status === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $post->status === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ $post->status === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@endsection
