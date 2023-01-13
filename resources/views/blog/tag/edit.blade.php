@extends('dashboard')
@section('title', 'Edit Tag')
@section('content')
    <div class="container w-50 mt-5">
        <h3 class="text-center">Edit Tag</h3>
        <form class="p-3 border border-dark" action="{{ route('tag.update', $tag) }}" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title"
                    value="{{ $tag->title }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="textarea" class="form-control" id="description" name="description"
                    value="{{ $tag->description }}">
            </div>
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
