<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'sku' => 'required|unique:products,sku',
            'category_id' => 'required',
            'brand_id' => 'required',
            'units' => 'required',
            'min_purchase_unit'=>'required|numeric|gte:1',
            'tags' => 'nullable',
            'is_refundable' => 'sometimes',
            'is_featured' => 'sometimes',
            'is_trending' => 'sometimes',
            'is_sellable' => 'sometimes',
              'best_selling' => 'sometimes',
              'is_deal' => 'sometimes',
            'order_custom_msg' => 'sometimes',
            'image' => 'required',
            'gallery_image_url' => 'required',
            'is_taxable' => 'sometimes',
            'tax_amount' => 'required_unless:is_taxable,null',
            'tax_type' => 'required_unless:is_taxable,null',
            'cost_price' => 'required|numeric|gte:1',
            'selling_price' => 'required|numeric|gte:1',
            'discount' => 'numeric',
            'discount_type' => 'required',
            'quantity' => 'required',
            'description' => 'nullable',
            'deal_date'=>'nullable',
        ];
    }
}
