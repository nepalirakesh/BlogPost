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
        $rules= [
            'author'=>[
            'required','integer'],
            'title'=>['required','alpha_num'],
            'description'=>['required'],
            'content'=>['required'],
            'image'=>['required','mimes:jpeg,png,jpg,gif,svg'],
            'category'=>['required','integer'],
            'tags'=>['required','array'],
        ];

        return $rules;
    }

}
