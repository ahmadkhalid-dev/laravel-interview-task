@extends('layouts.master')

@section('title', 'Post Detail')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>{{ $post->title }}</h2>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $post->content }}</p>
                <p class="text-muted">Author: {{ $post->author->name }}</p>
                <p class="text-muted">Created at: {{ $post->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to All Posts</a>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit Post</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection
