@extends('bloglayout.master')
<center>
    <div class="title">
     <h1><p>Posts</p></h1>
    
    </div>
    
    @if (session('created'))
    <div class="alert alert-success">
     {{ session('created') }}

    </div>
    @endif
    @if (session('deleted'))
    <div class="alert alert-danger">
     {{ session('deleted') }}

    </div>
    @endif
    @if (session('updated'))
    <div class="alert alert-success">
     {{ session('updated') }}

    </div>
    @endif
    </center>
    

    
    
<center>
 <div class="table">
 <table class="table-hover" >
     
     <tr>
         <th>Id</th>
         <th>Name</th>
         <th>Image</th>
         <th>Description</th>
         
         <th>Action</th>
     </tr>
         @foreach($authors as $author)
         <tr>
          <td>{{$author['id']}}</td>
         <td>{{$author['name']}}</td>
         <td> <img src="{{ url('public/images/'.$author->image) }}" style="height: 100px; width: 150px;"></td>
         <td>{{$author['description']}}</td>
         
         <td>
             <div style="display:flex;flex-direction:row; ">
             <a class="btn btn-primary"  href="edit/{{ $author['id']}}"> Edit </a>
           
         <form action="{{route('delete',$author->id)}}" method="POST">
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

 
</center>