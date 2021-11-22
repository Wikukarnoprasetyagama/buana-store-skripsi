<?php

namespace App\Http\Requests;

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
            'photo*' => 'required|image',
            'users_id' => 'integer|exists:users,id',
            'categories_id' => 'required|exists:categories,id',
            'name_product' => 'required|string|max:255',
            'price' => 'required|integer',
            'discount' => 'string|nullable',
            'discount_amount' => 'integer|nullable',
            'description' => 'required|string',
        ];
    }
}
