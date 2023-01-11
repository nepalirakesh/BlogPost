@extends('dashboard')

@section('content')
<h1>Post Index</h1>
@foreach($posts as $post)
    <ul>{{$post->id}}
    @foreach($post->tag as $tag)
        <li>{{$tag->id}}</li>
     @endforeach
    </ul>
    @endforeach


@endsection