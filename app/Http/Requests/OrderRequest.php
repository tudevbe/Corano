<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ten_nguoi_nhan' => 'required|string|max:255',
            'sdt_nguoi_nhan' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
            'email_nguoi_nhan' => 'required|string|email|max:255',
            'dia_chi_nguoi_nhan' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'ten_nguoi_nhan.required' => 'Tên người nhận bắt buộc điền',
            'ten_nguoi_nhan.string' => 'Tên người nhận không được là số',
            'ten_nguoi_nhan.max' => 'Tên người nhận quá dài',
            'sdt_nguoi_nhan.required' => 'Số điện thoại bắt buộc điền',
            'sdt_nguoi_nhan.regex' => 'Số điện thoại sai định dạng',
            'sdt_nguoi_nhan.min' => 'Số điện thoại sai định dạng',
            'sdt_nguoi_nhan.max' => 'Số điện thoại sai định dạng',
            'email_nguoi_nhan.required' => 'Bạn phải nhập email',
            'email_nguoi_nhan.string' => 'Email phải là chuỗi kí tự',
            'email_nguoi_nhan.email' => 'Email sai định dạng',
            'email_nguoi_nhan.max' => 'Email không được quá 255 kí tự',
            'dia_chi_nguoi_nhan.required' => 'Bạn phải nhập địa chỉ nhận hàng',
            'dia_chi_nguoi_nhan.string' => 'Địa chỉ phải là chuỗi kí tự',
            'dia_chi_nguoi_nhan.max' => 'Địa chỉ không quá 255 kí tự',
        ];
    }
}
