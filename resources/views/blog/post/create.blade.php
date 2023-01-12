@extends('dashboard')

@section('content')
<div class="container w-50 mt-5">
    <h3 class="text-center">Create Post</h3>
    <form class="p-3 border border-dark" action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="Author">Author</label>
            <select class="form-control" id="Author" name="author">
             @foreach($authors as $author)
                <option value={{$author->id}}>{{$author->name}}</option>
            @endforeach
            </select>
          </div>


          <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter title" name="title">
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <input type="textarea" class="form-control" id="description" placeholder="Enter short description about post" name="description">
        </div>

        <div class="form-group">
            <label for="content">content</label>
            <input type="textarea" class="form-control" id="content" placeholder="Enter you post here " name="content">
          </div>

          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image"  name="image">
          </div>

          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
              @foreach($categories as $category)
                <option value={{$category->id}}>{{$category->title}}</option>
            @endforeach
            </select>
          </div>

          <div>
            <label for="multiple_tag">Tag</label>
            <select name="tags[]" id="multiple_tag" multiple="" >
              @foreach($tags as $tag)
                <option value="{{$tag->id}}" syle="color:black">{{$tag->title}}</option>
            @endforeach

            </select>

          </div>
          {{-- <div class="form-group">
            <select class="form-control" name="tags[]" multiple="multiple">
              @foreach($tags as $tag)
              <option style="color:black"value="{{$tag->id}}">{{$tag->title}}</option>
          @endforeach
            </select>
          </div> --}}
        
         
        

        @csrf
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>


@endsection
