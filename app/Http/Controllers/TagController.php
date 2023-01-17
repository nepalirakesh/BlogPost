<?php

namespace App\Http\Controllers;
use App\Http\Requests\TagRequest;
use App\Models\Tag;



class TagController extends Controller
{
    /**
     * Show all Tags.
     *  @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $tags=Tag::Paginate(4);
        return view('blog.tag.index',compact('tags'));
    }

    /**
     * Send form to create tag.
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(){
        return view('blog.tag.create');
    }

    /**
     * Store request to tags table.
     * @param TagRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(TagRequest $request){
        $data=$request->validated();
        Tag::create($request->all());
        return redirect()->route('tag.index')->with('success','Tag created successfully.');
    }

    /**
     * Show specific tag.
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Tag $tag){
        return view('blog.tag.show',compact('tag'));
    }

    /**
     * Show form with tag data to be edited.
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Tag $tag){
        return view('blog.tag.edit',compact('tag'));
    }

    /**
     * Update the given tag as requested.
     * @param TagRequest $request
     * @param Tag $tag
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(TagRequest $request, Tag $tag){
        $data=$request->validated();
        $tag->update($request->all());
        return redirect()->route('tag.index')->with('update','Tag updated successfully.');
    }

    /**
     * Delete particular tag.
     * @param Tag $tag
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Tag $tag){
        $tag->delete();
        return redirect()->route('tag.index')->with('delete','Tag deleted successfully.');
    }
}
