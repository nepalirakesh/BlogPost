@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="display: flex; justify-content:space-between">
            <div class="card">
                <div class="card-header">
                    <a href="{{url('/')}}" type="button" class="btn btn-primary btn-sm float-right">Back</a>
                    <h3>{{ucfirst($posts->title)}}</h3>

                </div>
                <center>
                    <img src="{{asset('storage/images/'.$posts->image)}}" class="card-img-top"
                        style="height:auto;width:80%;" alt="...">
                </center>
                <div class="card-body">

                    <p class="text-center">{{ucfirst($posts->description)}}</p>
                    <p>{!! ucfirst($posts->content) !!}</p>
                </div>
                <div class="ml-4">
                    @foreach($posts->tag as $pt)
                    <span style="color:blue;">#{{$pt->title}}</span>
                    @endforeach
                </div>

                <div class="card-footer" style="display: flex; align-items: center">
                    <div class="image">
                        <img src="{{asset('storage/images/'.$posts->author->image)}}" class="img-circle elevation-2"
                            style="height:35px;width:35px;" alt="User Image">
                        <p class="font-italic">{{$posts->author->name}}</p>
                    </div>
                    <p style="margin:0px; margin-left:30px">{!!ucfirst($posts->author->description)!!}</p>
                </div>

            </div>
            {{-- <div class="card border-secondary mb-3" style="max-width: 18rem;margin-left:20px;">
                <div class="card-header">Recent Posts</div>
                <div class="card-body text-secondary">
                    <h5 class="card-title">Secondary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div> --}}

        </div>

    </div>
    @endsection