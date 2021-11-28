<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'           => 'required|min:10',
            'feature_image'  => 'required|mimes:jpg,bmp,png',
            'price'          => 'integer',
            'category'       =>'required',
            'description'    => 'required',


        ];
    }
    public function messages()
    {
        return[
            'name.required'  => 'Tên sản phẩm là bắt buộc',
            'name.min' => 'Tên sản phẩm không dưới 10 ký tự',
            'feature_image.required' => 'Ảnh đại diện là bắt buộc',
            'feature_image.mimes' => 'File phải là đuổi jpg,bmp,png',
            'price.integer' => 'Giá không đúng định dạng',
            'category.required' =>' Chuyên mục là bắt buộc',
            'description.required' => 'Mô tả phải bắt buộc',


        ];
    }
}
