<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CommentsRequest;

use App\Post;

class CommentsController extends Controller
{
    public function store(Post $post,CommentsRequest $request)
    {
    	$post->comments()->create($request->all());

    	return redirect()->back()->with('message','Your comment successfully posted.');
    }
}
