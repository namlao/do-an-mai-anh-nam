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
            'cpu' => 'required',
            'ram' => 'required',
            'hard_drive' => 'required',
            'os' => 'required',
            'weight' => 'required|numeric',
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
            'cpu.required' => 'CPU phải có',
            'ram.required' => 'Ram phải có',
            'hard_drive.required' => 'Ổ cứng phải có',
            'os.required' => 'Hệ điều hành phải có',
            'weight.required' => 'Khối lượng phải có',
            'weight.numeric' => 'Khối lượng phải là số',
        ];
    }
}
