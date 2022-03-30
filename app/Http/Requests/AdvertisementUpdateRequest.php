<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdvertisementUpdateRequest extends FormRequest
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
              Rule::unique('advertisements', 'name')->ignore($this->advertisement->id)
            ],
            'brand_id' => 'nullable|exists:brands,id',
            'rank' => 'required|numeric',
            'columns' => 'required|numeric',
            'advertisement_placement_id' => 'required|exists:advertisement_placements,id',
            'status' => 'sometimes',
            'image_url'=>'nullable',
            'link'=>'nullable'

        ];
    }
}
