<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AuthorRequest extends FormRequest
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
        $rules =  [
            'name' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'email' => 'required|email|unique:authors,email,' . $this->id,
            'image' => ($this->method() === 'PUT') ? 'mimes:jpeg,jpg,png,gif' :'required|mimes:jpeg,jpg,png,gif',
            'description' => 'required|max:300|min:10',
        ];

     
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            // 'name.alpha' => 'Name must be string',
            'name.max' => 'Name longer than required',
            'image.required' => 'Image is required',
            'description.required' => 'Description is required',
        ];
    }
}
