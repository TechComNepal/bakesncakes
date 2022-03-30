<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogUpdteRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'title' => 'required',
            Rule::unique('blogs','title')
            ->ignore($this->blog->id),
            'description' => 'required',
            'tags' => 'required',
            'image' => 'nullable'

            
        ];
        
    }
}
