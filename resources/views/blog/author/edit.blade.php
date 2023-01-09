@extends('bloglayout.master')
<style>
    .form{
          margin: auto;
        width: 50%;
       
        padding: 10px;
      }

      .form-group{
          margin: auto;
       width: 50%;
       border: 3px solid black;
      padding: 10px;};
</style>
    <center><h1>Edit</h1></center>
    
    <form method="Post" action="{{route('update',$authors->id)}}" enctype="multipart/form-data">  
    @method('PATCH')     
     @csrf     
              <div class="form-group">      
                  <label for="Id">Id:</label><br/><br/>  
                  <input type="number" name="id" value={{$authors->id}}><br/>
                  
                  <br/>  
              
      
          
                  <label for="Name">Name</label><br/><br/>  
                  <input type="text" class="form-control" name="name" value={{$authors->name}}>
                  <span style="color:red">@error('name'){{$message}}@enderror</span><br>
                  <br/>  
               
          
                  <label for="Image">Image</label><br/><br/>
                  <img src="{{ url('public/images/'.$authors->image) }}" style="height: 100px; width: 150px;">  
                  <input type="file" class="form-control" name="image" value={{$authors->image}}>
                  <span style="color:red">@error('image'){{$message}}@enderror</span><br>
          
                  <label for="Description">Description</label><br/><br/>  
                  <input type="text" class="form-control" name="description" value={{$authors->description}}>
                  <span style="color:red">@error('description'){{$message}}@enderror</span><br>  
               
    <br/>  
      
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>  