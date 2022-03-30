<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromoCodeStoreRequest extends FormRequest
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
            'product_id'=>'nullable|exists:products,id',
            'category_id'=>'nullable|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'coupon_code'=>'required|unique:promocodes,coupon_code',
            'type'=>'required',
            'rate'=>'required|numeric|min:0',
            'start_from'=>'required|date|before:expires_on',
            'expires_on'=>'required|date|after:start_from',
        ];
    }
}
