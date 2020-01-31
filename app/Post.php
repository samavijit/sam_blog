<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use GrahamCampbell\Markdown\Facades\Markdown;
use Carbon\Carbon;

class Post extends Model
{
    use SoftDeletes;
    
	protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published_at', 'category_id','view_count','image'];

	protected $dates = ['published_at'];

    protected $appends =['image_url'];
	
	public function getRouteKeyName()
	{
	    return 'slug';
	}

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

	public function author(){

		return $this->belongsTo(User::class,'author_id');
	}

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setSlugAttribute(){
        $this->attributes['slug'] = str_slug($this->title , "-");
    }

    public function getImageUrlAttribute($value)
    {
    	$imageUrl="";

    	if(!is_null($this->image)){

    		$imagePath = public_path()."/img/".$this->image;
    		if(file_exists($imagePath)){
    			$imageUrl = asset('img/'.$this->image);
    		}
    	}

    	return $imageUrl;
    	
    }

    public static function archives()
    {
        return static::selectRaw('count(id) as post_count,year(published_at) as year,monthname(published_at) as month')
                        ->published()
                        ->groupBy('year','month')
                        ->orderByRaw('min(published_at) desc')
                        ->get();
    }

    public function getThumbImageUrlAttribute($value)
    {
        $imageUrl="";

        if(!is_null($this->image)){
            $ext = substr(strrchr($this->image,'.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = public_path()."/img/".$thumbnail;
            if(file_exists($imagePath)){
                $imageUrl = asset('img/'.$this->image);
            }
        }

        return $imageUrl;
        
    }


    public function getDateAttribute($value)
    {
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function getTagHtmlAttribute($value)
    {
        $anchors = array();
        foreach ($this->tags as $tag) {

           $anchors[] = '<a href="'.route('tag',$tag->slug).'">'.$tag->name.'</a>'; 
            
        }

        return implode(',', $anchors);
    }


    public function scopeLatestFirst($query)
    {
    	return $query->orderBy('published_at','desc');
    }

     public function scopePopular($query)
    {
        return $query->orderBy('view_count','desc');
    }

    public function scopeCategoryNotNull($query)
    {
        return $query->whereNotNull('category_id');
    }

    public function scopePublished($query)
    {
    	return $query->where('published_at','<=',Carbon::now());
    }

    public function scopeScheduled($query)
    {
        return $query->where('published_at','>',Carbon::now());
    }
    
    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }


   public function scopeFilter($query, $filter)
    {
        if (isset($filter['month']) && $month = $filter['month'])
        {
            $query->whereMonth('published_at', '=', Carbon::parse($month)->month);
        }

        if (isset($filter['year']) && $year = $filter['year'])
        {
            $query->whereYear('published_at', '=', $year);
        }
        // check if any term entered
        if (isset($filter['term']) && $term = $filter['term'])
        {
            $query->where(function($q) use ($term) {
             
                $q->whereHas('author',function($qr) use($term){
                    $qr->where('name', 'LIKE' , "%{$term}%");
                });

                $q->whereHas('category',function($qr) use($term){
                    $qr->where('title','LIKE',"%{$term}%");
                });

               /* $q->whereHas('tags',function($qr) use($term){
                    $qr->where('name','LIKE',"%{$term}%");
                });*/

                $q->orWhere('title','LIKE',"%{$term}%");

                $q->orWhere('excerpt','LIKE',"%{$term}%");
            });
        }
    }

    public function getBodyHtmlAttribute()
    {
       
        return Markdown::convertToHtml($this->body);
        
    }

    public function getExcerptHtmlAttribute()
    {
       
        return Markdown::convertToHtml($this->excerpt);
        
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "d/m/Y";
        if($showTimes) $format = $format." H:i:s";

        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {
        if ( ! $this->published_at) {

            return '<span class="label label-warning">Draft</span>';

        }elseif ($this->published_at && $this->published_at->isFuture()) {
            return '<span class="label label-info">Schedule</span>';
        }else{

            return '<span class="label label-success">Published</span>';
        }
    }

     


}
