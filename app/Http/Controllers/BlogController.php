<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\User;
use App\Category;

use App\Tag;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // \DB::connection()->enableQueryLog();
        $posts = Post::with(['author','category','tags','comments'])->latestFirst()->categoryNotNull()->published()->filter(request()->only(['term','month','year']))->simplePaginate(3);
        return view('blog.index',compact('posts'));

      // return $queries = \DB::getQueryLog();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category(Category $category)
    {
        $categoryName = $category->title;
        $posts = $category->posts()->with(['author','tags','comments'])->latestFirst()->categoryNotNull()->published()->simplePaginate(3);

        return view('blog.index',compact('posts','categoryName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function author(User $author)
    {
        $authorName = $author->name;

        $posts = $author->posts()->with(['category','tags','comments'])->latestFirst()->categoryNotNull()->published()->simplePaginate(3);

        return view('blog.index',compact('posts','authorName'));
    }

     public function tag(Tag $tag)
    {
        $tagName = $tag->name;

        $posts = $tag->posts()->with(['category','author','comments'])->latestFirst()->categoryNotNull()->published()->simplePaginate(3);

        return view('blog.index',compact('posts','tagName'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->increment('view_count');
        $postComments = $post->comments()->simplePaginate(2);
        return view('blog.show',compact('post','postComments'));
    }

   
}
