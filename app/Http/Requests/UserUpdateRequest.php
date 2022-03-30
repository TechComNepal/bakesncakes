<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'email|required|' . Rule::unique('users', 'email')->ignore($this->user->id),
            'name' => 'required|'. Rule::unique('users', 'name')->ignore($this->user->id),
            'username' => 'required|'. Rule::unique('users', 'username')->ignore($this->user->id),
            'role_id'=>'required|exists:roles,id',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'nullable',
            'image' => 'sometimes',
        ];
    }
}
