<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
use GuzzleHttp\Psr7\Request;

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
        $rules = [
            'title' => ($this->method() === "PUT") ? 'required|string|max:100|unique:categories,title,' . $this->category->id : 'required|string|max:100|unique:categories,title,',
            'description' => 'required|max:300|min:10'
        ];

        return $rules;
    }
}
