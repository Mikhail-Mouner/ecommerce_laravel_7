<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
        switch($this->method()) {
            case 'POST':
                return [       
                    'name' => 'required|string|max:25',
                    'password' => 'required|string|min:4|max:25',
                    'mobile' => 'required|numeric|unique:vendors,mobile',
                    'address' => 'required',
                    'email' => 'required|email|unique:vendors,email',
                    'category_id' => 'required|exists:App\Models\MainCategory,id',
                    'photo' => 'required|image',
                    'lat' => 'required|numeric',
                    'long' => 'required|numeric'
                ];
            case 'PUT':
            case 'PATCH':
                return [       
                    'name' => 'required|string|max:25',
                    'password' => 'max:25',
                    'mobile' => 'required|numeric|unique:vendors,mobile,'.$this->id,
                    'address' => 'required',
                    'email' => 'required|email|unique:vendors,email,'.$this->id,
                    'category_id' => 'required|exists:App\Models\MainCategory,id',
                    'photo' => 'image',
                    'lat' => 'required|numeric',
                    'long' => 'required|numeric'
                ];
            default:break;
        }
    }
    public function messages()
    {
        return [
            'required' => 'This Field Was Required',
            'in' => 'Wrong Date (in)',
            'string' => 'Wrong Date (string)',
            'image' => 'Upload Image File',
            'max'=> 'Maximum Size'
        ];
    }
}
