<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

        $rules = [
            'author_id'   => 'required|integer',
            'title'       => 'required|string',
            'description' => 'required|min:30|max:150',
            'content'     => 'required|min:100',
            'image'       => ($this->method() === 'PUT') ? 'mimes:jpeg,png,jpg,gif,svg' : 'required|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required|integer',
            'tags'        => 'required|array',
        ];

        return $rules;
    }
}
