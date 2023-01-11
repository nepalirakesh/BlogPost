<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Tag;
use App\Models\Category;

class PostController extends Controller
{
    public function index(){
        $posts=Post::all();
        return view('blog.post.index',compact('posts'));

    }

    public function create(){
        
        $tags=Tag::all();
        $categories=Category::all();
        $authors=Author::all();

        return view('blog.post.create',compact('tags','categories','authors'));
    }

    
    
    public function store(PostRequest $request){


        $data = $request->validated();
        $post = new Post;
  
        $post->author_id = $data['author'];
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->content = $data['content'];
        $post->category_id = $data['category'];

        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=$file->getClientOriginalName();
            $file->storeAs('public/images/',$filename);
            $post->image=$filename;
        }
   
        $post->save();
        $post->tag()->attach($request->tags);
   
        return redirect()->route('post.index'); 
    
 }




    public function edit(Post $post){
        
        $categores=Category::all();
        $tags=Tag::all();
        $author=Author::all();
        return view('blog.post.edit',compact('post','categories','tags','author'));

    }

    public function update(Post $post, Request $request){

    }

    public function delete(Post $post){

    }
}
