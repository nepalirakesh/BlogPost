<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Author;
use App\Models\Tag;
use App\Models\Category;


class IndexController extends Controller
{


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
                return view('home',compact('posts','categories'))->with('success','cat->title');
             }

        }

        public function singlePostShow($id){
             $posts = Post::find($id);
            $latest_post = Post::latest()->first();
    
            // $categories = Category::all();
            // $tags = Tag::all();
            // $authors = Author::all();
    
    
            return view('page', compact(['posts', 'latest_post']));
    
        }

        // ------------------------------Ajax call ------------------------------
    //     public function getCategory(Request $request)
    //     {
    //         $id = $request->post('category_id');
    //         $categories = Category::all();
    //         if ($id !== null){
    //             $posts = Post::where('Category_id',$id)->get();
    //             //  return view('home',compact('posts','categories'));
    //             return response()->json(['posts' => $posts , 'categories' => $categories]);
    //     }
    // }


}
