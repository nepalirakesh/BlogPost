@extends('dashboard')
@section('title', 'Show Tag')
@section('content')
    <div class="container mt-5">
        <h3 class="text-center">Tag</h3>
        <div class="container border border-dark p-2 w-50">
            <h5> {{ ucfirst($tag->title) }}</h5>
            <hr>
            <p>{!! ucfirst($tag->description) !!}</p>
        </div>
        <div class="container text-center p-2 w-50">
            <form action="{{ route('tag.delete', $tag) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('tag.index') }}" class="btn btn-primary btn-sm">Index</a>
                <a href="{{ route('tag.edit', $tag) }}" class="btn btn-secondary btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm" type="submit"
                    onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
