<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'categories_id' => 'required|integer|exists:categories,id',
            'photo' => 'mimes:jpg',
            'name_product' => 'required|string|max:255',
            'price' => 'required|integer',
            'discount' => 'string|nullable',
            'discount_amount' => 'integer|nullable',
            'code_discount' => 'string|nullable',
            'description' => 'required|string',
        ];
    }
}
