<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceUpdateRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
   
    public function rules()
    {
        return [
            'title' => 'required',
            Rule::unique('services', 'title')->ignore($this->service->id),
            'description' => 'required'
        ];
    }
}
