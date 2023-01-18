@extends('dashboard')
@section('title', 'Create Tag')
@section('content')
    <div class="container w-50 mt-5">
        <h3 class="text-center">Create Tag</h3>
        <form class="p-3 border border-dark" action="{{ route('tag.store') }}" method="POST">
            @csrf
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
                <textarea class="form-control" name="description" id="my-editor" rows="3" placeholder="Enter Description">{{ old('description') }}</textarea>
                <span style="color:red">
                    @error('description')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
@push('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('my-editor');
</script>
@endpush

