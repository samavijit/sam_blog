<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests\PostRequest;
use Intervention\Image\Facades\Image;

use App\Post;
use App\Category;


class BlogController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $uploadPath;

    public function __construct(){

        parent::__construct();

        $this->uploadPath = public_path(config('cms.image.directory'));
    }

    public function index(Request $request)
    {
        $onlyTrashed = false;
        if(($status = $request->get('status')) && $status == 'trash'){

            $posts = Post::onlyTrashed()->with('category','author')->latest()->categoryNotNull()->paginate(10);

            $postCount = Post::onlyTrashed()->categoryNotNull()->count();

            $onlyTrashed = true;
        }
        elseif ($status == 'published') {

            $posts      = Post::published()->with('category','author')->latest()->categoryNotNull()->paginate(10);

            $postCount  = Post::published()->categoryNotNull()->count();
            
        }elseif ($status == 'scheduled') {

            $posts      = Post::scheduled()->with('category','author')->latest()->categoryNotNull()->paginate(10);

            $postCount  = Post::scheduled()->categoryNotNull()->count();
            
        }elseif ($status == 'draft') {

            $posts      = Post::draft()->with('category','author')->latest()->categoryNotNull()->paginate(10);

            $postCount  = Post::draft()->categoryNotNull()->count();
            
        }
        elseif ($status == 'own') {

            $posts      = $request->user()->posts()->with('category','author')->latest()->categoryNotNull()->paginate(10);

            $postCount  = $request->user()->posts()->categoryNotNull()->count();
            
        }
        else{
            $posts      = Post::with('category','author')->latest()->categoryNotNull()->paginate(10);

            $postCount  = Post::categoryNotNull()->count();

        }
        
        $statusLists = $this->statusList($request);

        //dd($posts);

        return view('backend.blog.index',compact('posts','postCount','onlyTrashed','statusLists'));
    }

    private function statusList($request){

        return [

            'own' => $request->user()->posts()->categoryNotNull()->count(),

            'all' => Post::categoryNotNull()->count(),

            'published' => Post::published()->categoryNotNull()->count(),

            'scheduled' => Post::scheduled()->categoryNotNull()->count(),

            'draft' => Post::draft()->categoryNotNull()->count(),

            'trash' => Post::onlyTrashed()->categoryNotNull()->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('backend.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
       // \DB::connection()->enableQueryLog();
       
        //dd($postRequest);
        $post_request = $this->handle_request($request);

        $post_request['view_count'] = 0;

        $user = $request->user();
        $user->posts()->create($post_request);

       // return $queries = \DB::getQueryLog();

       // die('aasas');

        return redirect('/backend/blog')->with('message','Your Post was created successfully!');
    }

    private function handle_request($request){

        $postRequest = $request->all();
        $postRequest['slug'] = str_slug($request->title , "-");
       // $postRequest['view_count'] = 0;

        if($request->hasFile('image')){

            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();

            $destination = $this->uploadPath;

            $successUploaded = $image->move($destination,$fileName);

            if($successUploaded){

                $width = config('cms.image.thumbnail.width');
                $height = config('cms.image.thumbnail.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                
                Image::make($destination.'/'.$fileName)
                        ->resize($width,$height)
                        ->save($destination.'/'.$thumbnail);
                } 
            
            $postRequest['image'] = $fileName;
        }

        return $postRequest;
      
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
        $post = Post::findOrFail($id);
        $categories = Category::all();
         return view('backend.blog.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //dd($request->all());
        $post = Post::findOrFail($id);

        $oldImage = $post->image;

        $post_request = $this->handle_request($request);

        
        $post->update($post_request);

        if($oldImage !== $post->image){

             $this->removeImage($oldImage);
        }

       

        return redirect('/backend/blog')->with('message','Your Post was updated successfully!');

    }

    public function restore($id)
    {
        //dd($request->all());
        $post = Post::withTrashed()->findOrFail($id);

        $post->restore();
        
       
        return redirect()->back()->with('message','Your Post was restored successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect('/backend/blog')->with('trash-message',['Your Post moved to trash.',$id]);
    }

    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        $post->forceDelete();

        $this->removeImage($post->image);

        return redirect('/backend/blog?status=trash')->with('message','Your Post deleted permanatly.');
    }

    private function removeImage($image){

        if(!empty($image)){

            $imagePath = $this->uploadPath.'/'.$image;

            $ext = substr(strrchr($image, '.'), 1);

            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);

            $thumbPath = $this->uploadPath.'/'.$thumbnail;

            if( file_exists($imagePath)) unlink($imagePath);

            if( file_exists($thumbPath)) unlink($thumbPath);
        }
    }
}
