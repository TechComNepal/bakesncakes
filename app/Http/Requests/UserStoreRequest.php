<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|unique:users,name',
            'username' => 'required|unique:users,username',
            'password'=>['required',
            Password::min(8)->letters()->numbers()->mixedCase()->symbols()->uncompromised() ],
            'password_confirmation' => 'required|same:password',
            'role_id'=>'required|exists:roles,id',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'nullable',
            'image' => 'nullable',
        ];
    }
}
