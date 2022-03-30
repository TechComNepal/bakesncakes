<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementStoreRequest extends FormRequest
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
            'name'=>'required|unique:advertisements,name',
            'brand_id'=>'required|exists:brands,id',
            'rank'=>'required|numeric',
            'advertisement_placement_id'=>'required|exists:advertisement_placements,id',
            'columns'=>'required|numeric',
            'status'=>'sometimes',
            'image_url'=>'required',
            'link'=>'nullable'
        ];
    }
}
