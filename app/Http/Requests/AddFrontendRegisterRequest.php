<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddFrontendRegisterRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'

        ];
    }
    public function messages()
    {
        return[
            'firstname.required' => 'Họ phải bắt buộc',
            'lastname.required' => 'Tên phải bắt buộc',
            'email.required' => 'email phải bắt buộc',
            'email.unique' => 'email đã được đăng ký',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password không ít quá 8 ký tự',
            'confirm_password.required' => 'Hãy xác nhận mật khẩu',
            'confirm_password.same' => 'Mật khẩu xác thực không trùng khớp',
        ];
    }
}
