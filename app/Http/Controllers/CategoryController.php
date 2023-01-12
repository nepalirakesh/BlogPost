<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){


        $categories= Category::Paginate(4);
        return view('blog.category.index',compact('categories'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function show(Category $category){

        return view('blog.category.show',compact('category'));


    }


    public function create(){

        return view('blog.category.create');
    }




    public function store(Request $request){

        $request->validate([
            'title'=>'required|unique:categories,title',
            'description'=>'required',
        ]);

        Category::create($request->all());
        return redirect()->route('category.index')->with('success','category created successfully');
    }




    public function edit(Category $category){

        return view('blog.category.edit',compact('category'));
    }


    public function update(Category $category,Request $request){

        $request->validate([
            'title'=>'required|unique:categories,title',
            'description'=>'required',
        ]);

        $category->update($request->all());
        return redirect()->route('category.index')->with('update','category updated successfully');
    }



    public function delete(Category $category){

        $category->delete();
        return redirect()->route('category.index')->with('delete','category deleted successfully');
    }
}
