<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use GrahamCampbell\Markdown\Facades\Markdown;

class Comment extends Model
{
	protected $guarded = [];
	
    public function post()
    {
    	return $this->belongsTo(Post::class);
    }

    public function getBodyHtmlAttribute()
    {
    	return Markdown::convertToHtml($this->body);
    }
}
