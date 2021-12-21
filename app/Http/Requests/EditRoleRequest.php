<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRoleRequest extends FormRequest
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
            'display_name' => 'required|unique:roles,display_name,'.$this->segments(4)[2].',id',
            'name' => 'required|unique:role,name,'.$this->segments(4)[2].',id',
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'display_name.required' => 'Tên hiển thị vai trò bắt buộc phải có',
            'display_name.unique' => 'Tên hiển thị vai trò đã bị trùng',
            'name.required' => 'Tên vai trò bắt buộc phải có',
            'name.unique' => 'Tên vai trò đã bị trùng',
            'description.required' => 'Mổ tả vai trò bắt buộc phải có',
        ];
    }
}
