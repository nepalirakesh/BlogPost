<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'title'=>'required|unique:tags,title',
            'description'=>'required|max:300|min:10'
        ];
    }

    /** 
     * Generate error message on validation failure.
     *
     * @return array     
     */
    public function message(){
        return [
            'title.required'=>'Title is required',
            'title.unique'=>'Title must be unique',
            'description.required'=>'Description is required',
            'description.max'=>'Description longer thand required',
        ];
    }
}
