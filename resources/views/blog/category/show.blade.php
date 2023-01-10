@extends('dashboard')

@section('content')

<div class="container mt-5">
    <h3 class="text-center">Categories</h3>

    <div class="container border border-dark p-2 w-50">
        <h5> {{$category->title}}</h5>
    <hr>
        <p>{{$category->description}}</p>
    </div>

    <div class="container p-2 w-50">


    <form action="{{route('category.delete',$category)}}" method="POST">

       @csrf
       @method('DELETE')
        <a href="{{route('category.index')}}" class="btn btn-primary btn-sm">Index</a>
        <a href="{{route('category.edit',$category)}}" class="btn btn-secondary btn-sm">Edit</a>
        <button class="btn btn-danger btn-sm" type="submit">Delete</button>

    </form>
</div>
</div>

@endsection
