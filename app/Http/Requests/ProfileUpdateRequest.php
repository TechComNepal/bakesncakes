<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'name'=>['required',
                    Rule::unique('users', 'name')->ignore($this->user->id),
        ],
        'username'=>['required',
                    Rule::unique('users', 'username')->ignore($this->user->id),
    ],
        'email'=>['required','email',
                Rule::unique('users', 'email')->ignore($this->user->id),
        ],
        'phone'=>'required',
        'city'=>'required',
        'address'=>'required',
        'avatar'=>'sometimes',
        ];
    }
}
