<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\CategoryAddRequest;
use App\Http\Requests\CategoryEditRequest;
use App\Http\Requests\CategoryDeleteRequest;
use App\Post;

class CategoryController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('posts')->orderBy('title')->paginate(10);
        $categoryCount = Category::count();
        return view('backend.category.index',compact('categories','categoryCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryAddRequest $request)
    {

        $postRequest = $request->all();
        $postRequest['slug'] = str_slug($request->title , "-");
        Category::create($postRequest);

        return redirect('/backend/category')->with('message','New Category created successfully');
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
        $category = Category::findOrFail($id);
        return view('backend.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryEditRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $postRequest = $request->all();
        $postRequest['slug'] = str_slug($request->title , "-");
        $category->update($postRequest);

        return redirect('/backend/category')->with('message','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryDeleteRequest $request, $id)
    {
        $post = Post::withTrashed()->where('category_id',$id)->update(['category_id' => config('cms.default_category_id')]);

       // $post->update(['category_id' => config('cms.default_category_id')]);

        $category = Category::findOrFail($id);
        
        $category->delete();

        return redirect('/backend/category')->with('message','Category deleted successfully');
    }
}
