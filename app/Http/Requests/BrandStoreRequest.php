<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandStoreRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name' => 'required|unique:brands,name',
            'short_description' => 'required',
            'status' => 'sometimes',
            'category_id' => 'nullable',
            'image' => 'required',
        ];
    }
}
