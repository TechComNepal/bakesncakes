<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

 
    public function rules()
    {
        return [
            'name'=>['required',
                Rule::unique('categories', 'name')->ignore($this->category->id),
            ],
            'order_level'=>'required|integer',
            'parent_id'=>'nullable',
            'status'=>'sometimes',
            'featured'=>'sometimes',
            'in_menu'=>'sometimes',
            'image'=>'nullable',
        ];
    }
}
