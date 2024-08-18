<?php

namespace App\Http\Requests\Product;

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
            'name' => 'required',
            'price' => 'required|numeric|gt:1000',
            'price_sale' => 'required|numeric|lt:price|gt:1000',
            'thumb' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên là bắt buộc!',
            'price.required' => 'Giá là bắt buộc!',
            'price.numeric' => 'Giá phải là một số!',
            'price_sale.required' => 'Giá khuyến mãi là bắt buộc!',
            'price_sale.numeric' => 'Giá khuyến mãi phải là một số!',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc!',
            'thumb.required' => 'Bạn chưa tải ảnh lên!',
            'price.gt:1000' => 'Giá tiền phải lớn hơn 1000',
            'price_sale.gt:1000' => 'Giá tiền phải lớn hơn 1000',
        ];
    }
}
