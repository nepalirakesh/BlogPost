<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    //For Index or Viewing
    public function show()
    {   
        $data = Author::all();
        
        return view('blog/author/index',['authors'=>$data]);
    }
    

    //For creating a new author
    public function store(AuthorRequest $request)
    {   

        $validatedData = $request->validated();  
        $author = new Author();
        $author->name = $request->name;
       // Image exists or not
       if($request->file('image'))
       {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('public/images'), $filename);
        $author->image = $filename;
       }
        $author->description = $request->description;
        $author->save();
        
        echo "success";
    }


    //For viewing edit page
    
     public function edit($id)
     {
        $author = Author::find($id);
        return view('blog/author/edit',['authors'=>$author]);

     }


     //For updating author information

     public function update(Request $request, $id)
    {   
        $request->validate([
            'name' =>'required|max:255',
            'description' =>'required|max:255',
            'image' => 'image|mimes:jpeg,jpg,png,gif',
        ]);
        $author = Author::find($id);
        $author->name = $request->name;
        
        if($request->file('image'))
       {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('public/images'), $filename);
        $author->image = $filename;
       }
       

        $author->description = $request->description;
        $author->save();

        return redirect('author');
    }

    //For deleting an author
    public function destroy($id)
    {
        Author::find($id)->delete();
        return redirect('author');
    }


}
