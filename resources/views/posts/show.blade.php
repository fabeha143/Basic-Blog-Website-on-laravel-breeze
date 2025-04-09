@extends('layouts.appnew')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p><strong>Slug:</strong> {{ $post->slug }}</p>
    <p><strong>Body:</strong></p>
    <p>{{ $post->body }}</p>
    <p><strong>Published:</strong> {{ $post->published ? 'Yes' : 'No' }}</p>

    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
