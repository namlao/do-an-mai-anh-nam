<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSlideRequest extends FormRequest
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
            'img_slide_path' => 'required|image',
            'title' => 'required',
            'description' => 'required|min:100|max:300',
        ];
    }
    public function messages()
    {
        return[
            'img_slide_path.required' => 'Ảnh slide phải bắt buộc',
            'img_slide_path.image' => 'Ảnh slide không đúng định dạng',
            'title.required' => 'Title phải bắt buộc',
            'description.required' => 'Mô tả ngắn phải bắt buộc',
            'description.min' => 'Mô tả không ít quá 100 ký tự',
            'description.max' => 'Mô tả không dài quá 300 ký tự',

        ];
    }
}
