<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
            //
            'name' => 'required|unique:categories,name,'.$this->segments(4)[2].',id',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên chuyên mục bắt buộc',
            'name.unique' => 'Tên chuyện mục bị trùng'
        ];
    }
}
