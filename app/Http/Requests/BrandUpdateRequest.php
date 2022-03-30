<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BrandUpdateRequest extends FormRequest
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
           'name' => ['required',
                Rule::unique('brands', 'name')
                ->ignore($this->brand->id),
            ],
            'short_description' => 'required',
            'status' => 'sometimes',
            'category_id' => 'nullable',
            'image' => 'nullable',
        ];
    }
}
