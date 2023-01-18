@extends('dashboard')
@section('title', 'Edit Tag')
@section('content')
    <div class="container w-50 mt-5">
        <h3 class="text-center">Edit Tag</h3>
        <form class="p-3 border border-dark" action="{{ route('tag.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title"
                    value="{{ $tag->title }}">
                <span style="color:red">
                    @error('title')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Description">{{ $tag->description }}</textarea>
                <span style="color:red">
                    @error('description')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
