<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'icon' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    
    public function messages () {
        return [
            'name.required' => 'The name is missing',
            'name.string' => 'wrong non text value for name',
            'icon.image' => 'The required file type is image',
            'icon.mimes:jpeg,png,jpg,gif' => 'The available icon extensions is jpeg,png,jpg,gif',
            'icon.max:2048' => 'Please upload icon size less than 2048',
        ];
    }


}
