<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestimonialUpdateRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'title' => 'required',
            Rule::unique('testimonials', 'title')->ignore($this->testimonial->id),
            'description' => 'required'
        ];
    }
}
