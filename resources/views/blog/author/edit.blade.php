@extends('dashboard')
@section('title', 'Edit Author')
@section('content')
    <div class="container w-50 mt-5">
        <h3 class="text-center">Edit Author</h3>
        <form class="p-3 border border-dark" action="{{ route('author.update', $author->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $author->name }}">
                <span style="color: red">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $author->email }}">
                <span style="color: red">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <br>
                <img class="mb-2"src={{ asset("storage/images/$author->image") }} width="100px" height="100px"
                    alt="">
                <input type="file" class="form-control" id="image" name="image" onchange="loadFile(event)">
                <span style="color: red">
                    @error('image')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div id="show" style="display:none;">
                <label for="preview">Image Preview</label><br>
                <img id="preview" width="100px" height="100px"><br><br>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{ $author->description }}</textarea>
                <span style="color: red">
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
