<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'required',
            'sku' => ['required',
                Rule::unique('products', 'sku')->ignore($this->product->id),
                ],
            'category_id' => 'required',
            'brand_id' => 'required',
            'units' => 'required',
            'min_purchase_unit'=>'required|numeric|gte:1',
            'tags' => 'nullable',
            'order_custom_msg' => 'sometimes',
            'image' => 'nullable',
            'gallery_image_url' => 'nullable',
            'is_taxable' => 'sometimes',
            'tax_amount' => 'required_with:is_taxable,',
            'tax_type' => 'required_with:is_taxable,null',
            'cost_price' => 'required|numeric|gte:1',
            'selling_price' => 'required|numeric|gte:1',
            'discount' => 'numeric',
            'discount_type' => 'required',
            'quantity' => 'required',
            'description' => 'nullable',
        ];
    }
}
