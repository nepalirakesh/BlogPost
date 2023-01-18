@extends('dashboard')
@section('title', 'Edit Category')
@section('content')
    <div class="container w-50 mt-5">
        <h3 class="text-center">Edit Category</h3>
        <form class="p-3 border border-dark" action="{{ route('category.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title"
                    value="{{ $category->title }}">
                <span style="color:red">
                    @error('title')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="my-editor" rows="3">{{ $category->description }}</textarea>
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
@push('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('my-editor');
</script>
@endpush

