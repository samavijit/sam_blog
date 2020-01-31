<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use App\Http\Requests\TagAddRequest;
use App\Http\Requests\TagEditRequest;
use App\Http\Requests\TagDeleteRequest;
use App\Post;
class TagsController extends BackendController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::with('posts')->orderBy('name')->paginate(10);
        $tagCount = Tag::count();
        return view('backend.tag.index',compact('tags','tagCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagAddRequest $request)
    {

        $postRequest = $request->all();
        $postRequest['slug'] = str_slug($request->name , "-");
        Tag::create($postRequest);

        return redirect('/backend/tags')->with('message','New tag created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('backend.tag.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagEditRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $postRequest = $request->all();
        $postRequest['slug'] = str_slug($request->name , "-");
        $tag->update($postRequest);

        return redirect('/backend/tags')->with('message','tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

       // $post->update(['tag_id' => config('cms.default_tag_id')]);

        $tag = Tag::findOrFail($id);

        $tag->posts()->detach();
        
        $tag->delete();

        return redirect('/backend/tags')->with('message','Tag deleted successfully');
    }
}
