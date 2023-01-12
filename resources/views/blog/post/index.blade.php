@extends('dashboard')

@section('content')
@include('bloglayout.crudmessage')



<div class="container text-center mt-5">
    <h3>Posts</h3>
    <table class="table container text-center"   >
        {{-- <table class="table container table-bordered w-75 text-center" style="table-layout: fixed"> --}}
        <thead class="thead-dark">
          <tr>
            <th scope="col">SN</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Category</th>
            <th scope="col">Tags</th>
            <th scope="col">Image</th>
            <th scope="col">Manage</th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
            <tr>
                <td style="text-align:center">{{++$i}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->author->name}}</td>
                <td>{{$post->category->title}}</td>
                <td>
                    @foreach($post->tag as $tag)
                        <span class="badge rounded-pill bg-dark">{{$tag->title}}</span>
                    @endforeach
                </td>
                <td>
                    <img src="{{asset("storage/images/$post->image")}}" alt="" width="50px" height="50px">
                </td>
                <td>
                    <form action="{{route('post.delete',$post)}}" method="POST">
                        <a href="{{route('post.show',$post)}}" class="btn btn-primary btn-sm" >Show</a>
                        <a href="{{route('post.edit',$post)}}" class="btn btn-secondary btn-sm" >Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                      
                    </form>
                 </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      
        <ul class="pagination justify-content-center">
          {!!$posts->links('pagination::bootstrap-4')!!}

        </ul>
</div>
@endsection