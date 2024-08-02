@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="card shadow p-3">   
        <h3 class="text-center">Edit Post</h3>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form method="POST" action="{{ route('posts.update', $post->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title')? is-invalid @enderror" value="{{ $post->title }}" id="title" name="title">
                @error('title')
                    <div class="text-danger">{{$message}}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content')? is-invalid @enderror" id="content" name="content">{{ $post->content }}</textarea>
                @error('content')
                    <div class="text-danger">{{$message}}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Author</label>
                <select id="author_id" name="author_id" class="form-control @error('author_id')? is-invalid @enderror">
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ $post->author_id == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                    @endforeach
                </select>
                @error('author_id')
                    <div class="text-danger">{{$message}}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
    </div>
</div>
@endsection
