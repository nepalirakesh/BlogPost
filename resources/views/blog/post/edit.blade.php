@extends('dashboard')

@section('content')
<div class="container w-50 mt-5">
    <h3 class="text-center">Edit Post</h3>
    <form class="p-3 border border-dark" action="{{route('post.update',$post)}}" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="Author">Author</label>
            <select class="form-control" id="Author" name="author" >
              <option>{{$post->author->name}}</option>
             @foreach($authors as $author)
                <option value={{$author->id}} {{$post->author_id==$author->id?'selected':''}}>{{$author->name}}</option>
            @endforeach
            </select>
            <span style="color: red">@error('author'){{$message}} @enderror</span>
          </div>


          <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" aria-describedby="emailHelp"  name="title" value={{$post->title}} >
          <span style="color: red">@error('title'){{$message}} @enderror</span>
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <input type="textarea" class="form-control" id="description" name="description" value={{$post->description}}>
          <span style="color: red">@error('description'){{$message}} @enderror</span>
        </div>

        <div class="form-group">
            <label for="content">content</label>
            <input type="textarea" class="form-control" id="content" value={{$post->content}}   name="content">
            <span style="color: red">@error('content'){{$message}} @enderror</span>

          <div class="form-group">
            <label for="image">Image</label>
            <br>
            <img src={{asset("storage/images/$post->image")}} width="100px" height="100px" alt="">
            <input type="file" class="form-control" id="image"  name="image">
            <span style="color: red">@error('image'){{$message}} @enderror</span>
          </div>

          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
              <option>{{$post->category->title}}</option>
              @foreach($categories as $category)
                <option value={{$category->id}}   {{ $post->category_id== $category->id ? 'selected' : '' }}>{{$category->title}}</option>
            @endforeach
            </select>
            <span style="color: red">@error('category'){{$message}} @enderror</span>
          </div>

          <div class="form-group">
            <label for="multiple_tag">Tag</label>
            <select class="form-control" name="tags[]" id="multiple_tag" multiple="" >
             
              @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->title}}</option>
            @endforeach

            </select>
            <span style="color: red">@error('tags'){{$message}} @enderror</span>

          </div>


        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
</div>


@endsection