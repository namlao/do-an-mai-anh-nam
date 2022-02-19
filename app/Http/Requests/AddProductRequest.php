<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'feature_image' =>'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'weight' => 'required|numeric',
            'quantity' => 'required',
            'length' => 'required',
            'height' => 'required',
            'width' => 'required',
            'delivery' => 'required',
            'warranty' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bắt buộc phải có tên sản phẩm',
            'feature_image.required' => 'Bắt buộc phải có ảnh đại diện sản phẩm',
            'price.required' => 'Bắt buộc phải có giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'category.required' => 'Hãy chọn chuyên mục',
            'description.required' => 'Mô tả sản phẩm không được để trống',
            'short_description.required' => 'Mô tả ngắn sản phẩm không được để trống',
            'weight.required' => 'Khối lượng phải có',
            'weight.numeric' => 'Khối lượng phải là số',
            'quantity.required' => 'Số lượng phải có',
            'length.required' => 'Chiều dài là bắt buộc',
            'height.required' => 'Chiều cao là bắt buộc',
            'width.required' => 'Chiều rộng là bắt buộc',
            'delivery.required' => 'Vận chuyển là bắt buộc',
            'warranty.required' => 'Bảo hành là bắt buộc',
        ];
    }
}
