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
<h1 style="text-align:center;">Create Author</h1>

<div class="form-group">

<form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
{{csrf_field()}}
   
    <label >Name</label><br>
    <input type="text" class="form-control" name="name"  /><br>
    <span style="color:red">@error('name'){{$message}}@enderror</span><br>
    <label>Image</label><br>
    <input type="file" class="form-control" name="image" /><br>
    <span style="color:red">@error('image'){{$message}}@enderror</span><br>
    <label>Description</label><br>
    <textarea class="form-control" name="description"></textarea><br>
    <span style="color:red">@error('description'){{$message}}@enderror</span><br>
    
    <br><input type="submit" class="btn btn-primary" value="Create" />
    
</form>
</div>