<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TermsAndConditionUpdateRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=>'nullable',
            'description'=>'nullable',
            'image'=>'nullable'
        ];
    }
}
