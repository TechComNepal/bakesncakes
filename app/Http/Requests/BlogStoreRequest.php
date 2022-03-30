<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {


        return[
            'title' => 'required|unique:blogs,title',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'required'
        ];

    }
       
}
