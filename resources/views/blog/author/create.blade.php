@extends('dashboard')
@section('title', 'Create Author')
@section('content')
    <div class="container w-50 mt-5">
        <h3 class="text-center">Create Author</h3>
        <form class="p-3 border border-dark" action="{{ route('author.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name of an Author" name="name"
                    value="{{ old('name') }}">
                <span style="color:red">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email"
                    value="{{ old('email') }}">
                <span style="color:red">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" onchange="loadFile(event)">
                <span style="color:red">
                    @error('image')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div id="show" style="display:none;">
                <label for="preview"> Image Preview</label><br>
                <img id="preview" width="100px" height="100px"><br><br>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="" rows="3" class="form-control"
                    placeholder="Enter descripton">{{ old('description') }}</textarea>
                <span style="color:red">
                    @error('description')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection
