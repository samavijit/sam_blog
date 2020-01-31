<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       // dd($this->input('published_val_at'));
        $rules = [
            'title'=>'required|unique:posts',
            'body'=>'required',
           // 'published_at'=>'date_format:Y-m-d H:i:s',
            'category_id'=>'required',
            //'image' =>'required|mimes:jpg,jpeg,bmp,png'
        ];
        if($this->method() == "PUT" || $this->method() == "PATCH"){

            $rules['title'] = 'required|unique:posts,title,'.$this->route('blog');
        }

        if($this->input('published_val_at') == 'published'){

            $rules['published_at'] = 'date_format:Y-m-d H:i:s';
        }

        return $rules;
        
    }
}
