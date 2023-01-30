@extends('dashboard')
@section('title', 'Create Post')
@section('content')
    <div class="container w-50 mt-5">
        <h3 class="text-center">Create Post</h3>
        <form class="p-3 border border-dark" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="Author">Author</label>
                <select class="form-control" id="Author" name="author_id">
                    <option disabled selected>Select Author</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}</option>
                    @endforeach
                </select>
                <span style="color:red">
                    @error('author')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp"
                    placeholder="Enter title" name="title" value="{{ old('title') }}">
                <span style="color:red">
                    @error('title')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="" rows="3"
                    placeholder="Enter Description">{{ old('description') }}</textarea>
                <span style="color:red">
                    @error('description')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="content">content</label>
                <textarea class="form-control" name="content" id="my-editor" cols="" rows="3"
                    placeholder="Enter you post here">{{ old('content') }}</textarea>
                <span style="color:red">
                    @error('content')
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
                <label for="preview">Image Preview</label><br>
                <img id="preview" width="100px" height="100px"><br><br>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category_id">
                    <option disabled selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value={{ $category->id }} {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}</option>
                    @endforeach
                </select>
                <span style="color:red">
                    @error('category')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div>
                <div class="form-group">
                    <label for="multiple_tag">Tag</label>
                    <select class="form-control"name="tags[]" id="multiple_tag" multiple="">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>{{ $tag->title }}
                            </option>
                        @endforeach
                    </select>
                    <br>
                    <span style="color:red">
                        @error('tags')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('my-editor');
</script>
@endpush

