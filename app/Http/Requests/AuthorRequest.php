<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' =>'required|alpha|unique:authors|max:30',
            'image'=>'required',
            'description' =>'required|max:300|min:10',
        ];
    }

    public function messages() {
            return [
                'name.required' => 'Name is required',
                'name.alpha' => 'Name must be string',
                'name.max' => 'Name longer than required',
                'image.required' => 'Image is required',
                'description.required' => 'Description is required',
            ];
             }

            }
