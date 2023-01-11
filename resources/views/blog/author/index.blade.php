@extends('dashboard')

@section('content')

<style>
    .pagination{
        justify-content: center;
    }
</style>
@include('bloglayout.crudmessage')
<center>
 <div class="table">
 <table class="table-hover" >
     
     <tr>
         <th>S.N</th>
         <th>Name</th>
         <th>Image</th>
         <th>Description</th>
         
         <th>Action</th>
     </tr>
         @foreach($authors as $author)
         <tr>
          <td>{{++$i}}</td>
         <td>{{$author['name']}}</td>
         <td> <img src="{{ asset('storage/images/'.$author->image) }}" style="height: 100px; width: 100px;"></td>
         <td>{{$author['description']}}</td>
         
         <td>
             <div style="display:flex;flex-direction:row; ">
             <a class="btn btn-primary"  href="edit/{{ $author['id']}}"> Edit </a>
           
         <form action="{{route('author.delete',$author->id)}}" method="POST">
           @csrf    
           @method('DELETE')
            <button type="submit" class="btn btn-danger"> Delete </button>
        </form> 

             </div>
        </td>
         </tr>

         
         @endforeach 
 </table>
      </div>
 

 </div>
 {!! $authors->links('pagination::bootstrap-4') !!}

 
</center>

@endsection