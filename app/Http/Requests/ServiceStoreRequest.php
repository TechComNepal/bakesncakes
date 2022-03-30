<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
  
    public function rules()
    {
        return [
            'title' => 'required|unique:services,title',
            'description' => 'required',
            'image'=>'required'
        ];
    }
}
