@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:150%;margin-left:-160px;" >
                <div class="card-header" style="display: flex; justify-content:space-between">
                    <div>
                    <h3>Welcome to BlogPost</h3></div>
                    <div class="btn-group" style="margin-left:40em;">
                      <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                      </button>
                        <ul class="dropdown-menu" id="category" name="category">
                          <!-- dropdown menu links -->
                          @foreach($categories as $category)
                          <li class="dropdown-item"><a href="{{route('home.cat',$category['id'])}}" style="color:black;">{{$category->title}}</a></li>
                          @endforeach
              
                        </ul>
                      </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-deck">
                      @foreach($posts as $post)
                        <div class="card">
                            <img src="{{asset('/storage/images/'.$post->image)}}" class="card-img-top" alt="...">
                          <div class="card-body">
                           <b> <h3 >{{$post->title}}</h3></b>
                            <p class="card-text">{{$post->description}}</p>
                            <a href="#" class="btn btn-primary">Learn More</a>
                          </div>
                          <div class="card-footer" style="display: flex; align-items: center">
                                <div class="image">
                                  <img src="{{asset('storage/images/'.$post->author->image)}}" class="img-circle elevation-2" style="height:35px;width:35px;" alt="User Image">
                                </div>
                                 <p style="margin:0px; margin-left:30px">{{$post->author->name}}</p>
                              </div>
                        </div>
                        @endforeach
            </div>
           </div>
           <ul class="pagination justify-content-center">
            {!!$posts->links('pagination::bootstrap-4')!!}
          </ul>
    </div>
</div>

@endsection


