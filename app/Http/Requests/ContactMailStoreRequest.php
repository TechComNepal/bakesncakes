<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactMailStoreRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
                'name' => 'required',
                'email' => 'required|email',
                'number' => 'required',
                'subject' => 'required',
                'usermessage' => 'required',
                'status' => '0',
        ];
    }
}
