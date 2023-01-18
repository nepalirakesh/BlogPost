@extends('dashboard')
@section('title', 'Edit Post')
@section('content')
    <div class="container w-50 mt-5">
        <h3 class="text-center">Edit Post</h3>
        <form class="p-3 border border-dark" action="{{ route('post.update', $post) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="Author">Author</label>
                <select class="form-control" id="Author" name="author">
                    <option>{{ $post->author->name }}</option>
                    @foreach ($authors as $author)
                        <option value={{ $author->id }} {{ $post->author_id == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}</option>
                    @endforeach
                </select>
                <span style="color: red">
                    @error('author')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title"
                    value={{ $post->title }}>
                <span style="color: red">
                    @error('title')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="" rows="3"
                    placeholder="Enter Description">{{ $post->description }}</textarea>
                <span style="color: red">
                    @error('description')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="content">content</label>
                <textarea class="form-control" name="content" id="content" cols="" rows="3"
                    placeholder="Enter Description">{{ $post->content }}</textarea>
                <span style="color: red">
                    @error('content')
                        {{ $message }}
                    @enderror
                </span>
                <div class="form-group">
                    <label for="image">Image</label>
                    <br>
                    <img src={{ asset("storage/images/$post->image") }} width="100px" height="100px" alt="">
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
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                        <option>{{ $post->category->title }}</option>
                        @foreach ($categories as $category)
                            <option value={{ $category->id }} {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}</option>
                        @endforeach
                    </select>
                    <span style="color: red">
                        @error('category')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="multiple_tag">Tag</label>
                    <select class="form-control" name="tags[]" id="multiple_tag" multiple="">
                        @foreach ($tags as $tag)
                            @foreach ($post->tag as $pt)
                                <option value="{{ $tag->id }}"{{ $pt->id == $tag->id ? 'selected' : '' }}>
                                    {{ $tag->title }}</option>
                            @endforeach
                        @endforeach
                    </select>
                    <span style="color: red">
                        @error('tags')
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
