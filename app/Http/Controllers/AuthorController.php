<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\AuthorRequest;
use App\Traits\ImageUpload;


class AuthorController extends Controller
{
    use ImageUpload;

    //For Index or Viewing
    public function show()
    {
        $authors = Author::paginate(4);

        return view('blog/author/index',compact('authors'))->with('i', (request()->input('page', 1) - 1) * 5);
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
        $author->image = $this->uploadImage($request->file('image'));

       }
        $author->description = $request->description;
        $author->save();

        return redirect('author')->with('success','Author Created Successfully');
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

        //Images upload
        if($request->file('image'))
       {
        $author->image = $this->uploadImage($request->file('image'));

       }


        $author->description = $request->description;
        $author->save();

        return redirect('author')->with('update','Author Updated Successfully');
    }

    //For deleting an author
    public function destroy($id)
    {
        Author::find($id)->delete();
        return redirect('author')->with('delete','Author Deleted Successfully');
    }

    


}
