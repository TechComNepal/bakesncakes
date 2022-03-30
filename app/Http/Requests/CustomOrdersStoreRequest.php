<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomOrdersStoreRequest extends FormRequest
{
    
    public function authorize()
    {
        return TRUE;
    }

 
    public function rules()
    {
        return [
            'name'=> 'required',
            'email'=> 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'city'=> 'required',
            'address'=> 'required',
            'primary_number'=> 'required|numeric',
            'secondary_number'=> 'nullable',
            'quantity'=> 'required',
            'date'=> 'required',
            'description'=> 'required',
            'gallery_image' => 'required',

            

        ];

    }
    }
