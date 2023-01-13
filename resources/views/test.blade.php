@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"style="display: flex; justify-content:space-between">
            <div class="card">
                <div class="card-header">
                    <h3>Post Title</h3>
                </div>
                <center>
                    <img src="{{asset('dist/img/blog.jpg')}}" class="card-img-top" style="height:auto;width:80%;" alt="...">
                </center>
                <div class="card-body">
                    
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas
                     et ad tenetur adipisci minus quisquam magnam perferendis unde impedit 
                     consectetur obcaecati facilis, quaerat recusandae sequi! Dicta obcaecati 
                     quidem eum maxime.</p>
                </div> 
              
                <div class="card-footer" style="display: flex; align-items: center">
                    <div class="image">
                      <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" style="height:35px;width:35px;" alt="User Image">
                    </div>
                     <p style="margin:0px; margin-left:30px">{{Auth::user()->name}}</p>
                </div>
                    


            </div>
            <div class="card border-secondary mb-3" style="max-width: 18rem;margin-left:20px;">
                <div class="card-header">Recent Posts</div>
                <div class="card-body text-secondary">
                  <h5 class="card-title">Secondary card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div> 
        </div>
    </div>
</div>
@endsection
