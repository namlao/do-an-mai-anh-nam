<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->segments(4)[2].',id',
            'password' => 'required|min:8'

        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Tên người dùng bắt buộc',
            'email.required' => 'Email người dùng bắt buộc',
            'email.unique' => 'Email người dùng đã bị trùng',
            'password.required' => 'Mật khẩu người dùng bắt buộc',
            'password.min' => 'Mật khẩu người dùng không dưới 8 ký tự',
        ];
    }
}
