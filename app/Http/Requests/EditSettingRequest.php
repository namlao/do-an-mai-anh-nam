<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSettingRequest extends FormRequest
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
            'config_name' => 'required',
            'config_key' => 'required|unique:settings,config_key,'.$this->segments(4)[2].',id',
            'config_value' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'config_name.required' => 'Tên key là bắt buộc',
            'config_key.required' => 'Key là bắt buộc',
            'config_key.unique' => 'Key đã bị trùng',
            'config_value.required' => 'Giá trị cần phải có'

        ];
    }
}
