<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use App\Models\Tag;


class IndexController extends Controller
{
    //
    public function index(){
        $posts = Post::all();
        return view('home', compact('posts'));
    }
    public function singlePostShow($id){



        $posts = Post::find($id);
        $latest_post = Post::latest()->first();



        // $categories = Category::all();
        // $tags = Tag::all();
        // $authors = Author::all();


        return view('test', compact(['posts', 'latest_post']));

    }

}
