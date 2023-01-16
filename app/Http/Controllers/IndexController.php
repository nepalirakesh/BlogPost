<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Author;
use App\Models\Tag;
use App\Models\Category;

class IndexController extends Controller
{
    //
     //For Frontend of BlogPost
     public function showFrontend()
     {   $categories=Category::all();
         $posts = Post::Paginate(3);
         return view('home',compact('posts','categories'));
         
     }

     //For showing category wise posts
   
        public function getCategory($id)
        {
            $cat = Category::find($id);
            $categories = Category::all();
             if($cat !== null){
                $posts = Post::where('Category_id',$id)->Paginate(3);
                return view('home',compact('posts','categories'));
             }

        }

}
