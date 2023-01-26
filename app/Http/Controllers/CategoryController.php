<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->Paginate(4);
        return view('blog.category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('blog.category.show', compact('category'));
    }


    public function create()
    {
        return view('blog.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $date=$request->validated();
        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'category created successfully');
    }

    public function edit(Category $category)
    {
        return view('blog.category.edit', compact('category'));
    }

    public function update(Category $category, CategoryRequest $request)
    {
        $data=$request->validated();
        $category->update($request->all());
        return redirect()->route('category.index')->with('update', 'category updated successfully');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('delete', 'category deleted successfully');
    }
}
