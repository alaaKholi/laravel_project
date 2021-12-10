<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
         
            'name' => 'required|string',
            'icon' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'string|max:198',
            'email' => 'required|email',
            'mobile' => 'numeric|regex:/(59)[0-9]{7}/',
            'category_id' => 'required|min:1',
        ];
    }

    
    public function messages () {
        return [
            'name.required' => 'The name is missing',
            'name.string' => 'wrong non text value for name',
            'icon.required' => 'The icon is missing',
            'icon.image' => 'The required file type is image',
            'icon.mimes:jpeg,png,jpg,gif' => 'The available icon extensions is jpeg,png,jpg,gif',
            'icon.max:2048' => 'Please upload icon size less than 2048',
            'address.string' => 'wrong non text value for name',
            'address.max:198' => 'Address must be less than 198 letters',
            'email.required' => 'The email is missing',
            'email.email' => 'The email formate is wrong',
            'mobile.numeric' => 'The mobile is only numbers',
            'mobile.regex:/(059)[0-9]{7}/' => 'The mobile must follow the formate 59#######',
            'category_id.required' => 'The category name is missing',
            'category_id.min:1' => 'The category id is required',

        ];
    }
}
