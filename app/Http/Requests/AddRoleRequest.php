<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRoleRequest extends FormRequest
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
            'display_name' => 'required|unique:role,display_name',
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'display_name.required' => 'Tên hiển thị vai trò bắt buộc phải có',
            'display_name.unique' => 'Tên hiển thị vai trò đã bị trùng',
            'description.required' => 'Mô tả vai trò bắt buộc phải có',
        ];
    }
}
