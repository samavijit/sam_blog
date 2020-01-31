<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Category;
use App\Post;
use App\Tag;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function($view){

            $categories = Category::with([
                'posts'=>function($query){
                    $query->published();
                }
            ])->orderBy('title','asc')->get();

            return $view->with('categories',$categories);
        });

        view()->composer('layouts.sidebar',function($view){

            $tags = Tag::has('posts')->get();

            return $view->with('tags',$tags);
        });

         view()->composer('layouts.sidebar',function($view){

            $archives = Post::archives();

            return $view->with('archives',$archives);
        });

        view()->composer('layouts.sidebar',function($view){

            $popularPosts = Post::published()->popular()->take(3)->get();
           return $view->with('popularPosts',$popularPosts);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
