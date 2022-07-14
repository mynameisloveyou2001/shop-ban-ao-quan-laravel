<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> 'required',
            'thumb'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.requried'=> 'Vui lòng nhập tên đầy đủ',
            'thumb.required'=>'Vui lòng nhập ảnh đại diện'
        ];
    }
}
