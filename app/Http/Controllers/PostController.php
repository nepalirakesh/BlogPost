<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use App\Traits\ImageUpload;



class PostController extends Controller
{

    use ImageUpload;
    /**
     * @return View
     */

    public function index()
    {
        $posts = Post::latest()->Paginate(4);
        return view('blog.post.index', compact('posts'));
    }


    public function create(): View
    {
        $tags = Tag::all();
        $categories = Category::all();
        $authors = Author::all();
        return view('blog.post.create', compact('tags', 'categories', 'authors'));
    }


    /**
     * @param PostRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse`
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();

        $post = new Post;
        $post->author_id = $data['author_id'];
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->content = $data['content'];
        $post->category_id = $data['category_id'];

        if ($request->hasFile('image')) {
            $post->image = $this->uploadImage($request->file('image'));
        }

        $post->save();
        $post->tags()->attach($request->tags);

        return redirect()->route('post.index')->with('success', 'post added successfully');
    }

    public function show(Post $post)
    {
        return view('blog.post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $authors = Author::all();
        return view('blog.post.edit', compact('post', 'categories', 'tags', 'authors'));
    }

    public function update(Post $post, PostRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->deleteImage($post->image);
            $post->image = $this->uploadImage($request->file('image'));
        }

        $post->author_id = $data['author_id'];
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->content = $data['content'];
        $post->category_id = $data['category_id'];
        $post->save();
        $post->tags()->sync($request->tags);

        return redirect()->route('post.index')->with('update', 'post updated successfully');
    }

    public function delete(Post $post)
    {
        $this->deleteImage($post->image);
        $post->delete();
        return redirect()->route('post.index')->with('delete', 'post deleted successfully');
    }
}
