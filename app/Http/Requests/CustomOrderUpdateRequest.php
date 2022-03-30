<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomOrderUpdateRequest extends FormRequest
{
  
    public function authorize()
    {
        return TRUE;
    }

    public function rules()
    {
         return [
          'status' => 'nullable',
];
    }
}
