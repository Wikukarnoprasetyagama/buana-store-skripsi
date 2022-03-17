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
            'users_id' => 'exists:users,id',
            'photo[]' => 'mimes:svg,jpg|max:2048',
            'categories_id' => 'exists:categories,id',
            'code' => 'string',
            'name_product' => 'string|max:255',
            'slug' => 'string|unique:products',
            'price' => 'integer',
            'discount' => 'string|nullable',
            'discount_amount' => 'nullable',
            'description' => 'string',
        ];
    }
}
