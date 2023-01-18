@extends('dashboard')
@section('title', 'Create Tag')
@section('content')
    <div class="container w-50 mt-5">
        <h3 class="text-center">Create Tag</h3>
        <form class="p-3 border border-dark" action="{{ route('tag.store') }}" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp"
                    placeholder="Enter title" name="title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="textarea" class="form-control" id="description"
                    placeholder="Enter short description about tag." name="description">
            </div>
            @csrf
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
