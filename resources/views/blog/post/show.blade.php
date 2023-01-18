@extends('dashboard')
@section('title', 'Show Post')
@section('content')
    <div class="container mt-5">
        <h3 class="text-center">Post</h3>
        <div class="container border border-dark p-2 w-50">
            <h5> {{ ucfirst($post->title) }}</h5>
            <a href=""><small>{{ ucfirst($post->category->title) }}</small></a>
            <hr>
            <div class="container text-center" style="border:2px grey solid">
                <img src="{{ asset("storage/images/$post->image") }}" alt="" width="500px" height="300px">
                <p>{{ ucfirst($post->description) }}</p>
                <hr>
                <p>{!! ucfirst($post->content) !!}</p>
            </div>
            @foreach ($post->tag as $tag)
                <a href=""><span>#{{ $tag->title }}</span></a>
            @endforeach
            <span style="float:right">By {{ ucfirst($post->author->name) }}</span>
        </div>
        <div class="container text-center p-2 w-50">
            <form action="{{ route('post.delete', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('post.index') }}" class="btn btn-primary btn-sm">Index</a>
                <a href="{{ route('post.edit', $post) }}" class="btn btn-secondary btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm" type="submit"
                    onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>

@endsection
