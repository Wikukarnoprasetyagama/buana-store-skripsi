<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'string|nullable',
            // 'email' => 'string|email|max:255|unique:users',
            // 'password' => 'string', 'min:8', 'confirmed',
            // 'photo_profile' => 'image',
            // 'name_store' => 'required|string|max:255',
            // 'phone' => 'required',
            // 'photo_shop' => 'image',
            // 'village' => 'string',
            // 'address' => 'string',
        ];
    }
}
