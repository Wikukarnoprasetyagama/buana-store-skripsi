<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenStoreRequest extends FormRequest
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
            'users_id' => 'required|exists:users,id',
            'photo_profile' => 'image',
            'name_store' => 'required|string|max:255',
            'phone' => 'required',
            'photo_shop' => 'image',
            'village' => 'string',
            'address' => 'string',
        ];
    }
}
