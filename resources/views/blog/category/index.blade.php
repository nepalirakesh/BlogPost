{{-- @extends('bloglayout.master') --}}
@extends('dashboard')

@section('content')

@include('bloglayout.crudmessage')
<div class="container text-center mt-5">
    <h3>Blog Category</h3>
    <table class="table container text-center w-50" >
        {{-- <table class="table container table-bordered w-75 text-center" style="table-layout: fixed"> --}}
        <thead class="thead-dark">
          <tr>
            <th scope="col" width="10%">SN</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
            <tr>

            <td style="text-align:center">{{++$i}}</td>
            <td>{{$category->title}}</td>
            <td>{{Str::limit($category->description,10)}}</td>

            <td>
                <form action="{{route('category.delete',$category)}}" method="POST">
                    <a href="{{route('category.show',$category)}}" class="btn btn-primary btn-sm" >Show</a>
                    <a href="{{route('category.edit',$category)}}" class="btn btn-secondary btn-sm" >Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                </form>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {!!$categories->links()!!}
</div>


@endsection


