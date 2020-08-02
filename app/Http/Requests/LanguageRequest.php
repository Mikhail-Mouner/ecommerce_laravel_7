<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'abbr' => 'required|string|max:10',
            'local' => 'required|string',
            //'active' => 'required|in:0,1',
            'direction'=> 'required|in:rtl,ltr'

        ];
    }
    public function messages()
    {
        return [
            'required' => 'This Field Was Required',
            'in' => 'Wrong Date',
            'string' => 'Wrong Date',
            'max'=> 'Maximum Size'
        ];
    }
}
