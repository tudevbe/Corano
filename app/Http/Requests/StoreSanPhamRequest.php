<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSanPhamRequest extends FormRequest
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
            'ma_san_pham' =>'required|max:10|unique:san_phams,ma_san_pham,'. $this->route('id'),
            'ten_san_pham' =>'required|max:255',
            'hinh_anh' =>'image|mimes:jpg,jpeg,png,gif',
            'gia_san_pham' =>'required|numeric|min:0',
            'gia_khuyen_mai' =>'numeric|min:0|lt:gia_san_pham',
            'mo_ta_ngan' =>'max:255',
            'so_luong' =>'integer|min:0',
            'ngay_nhap' =>'required|date',
            'danh_muc_id' =>'required|exists:danh_mucs,id',
        ];
    }

    public function messages(): array
    {
        return [
            'ma_san_pham.required' =>'Bạn phải nhập mã sản phẩm',
            'ma_san_pham.max' =>'Mã sản phẩm không quá 10 kí tự',
            'ma_san_pham.unique' =>'Mã sản phẩm đã tồn tại',
            'ten_san_pham.required' =>'Bạn phải nhập tên sản phẩm',
            'ten_san_pham.max' =>'Mã sản phẩm không quá 10 kí tự',
            'hinh_anh.image' =>'Hình ảnh không hợp lệ',
            'hinh_anh.mimes' =>'Hình ảnh không hợp lệ',
            'gia_san_pham.required' =>'Bạn phải nhập giá sản phẩm',
            'gia_san_pham.numeric' =>'Giá sản phẩm phải là số',
            'gia_san_pham.min' =>'Giá sản phẩm phải lớn hơn 0',
            'gia_khuyen_mai.numeric' =>'Giá khuyến mãi phải là số',
            'gia_khuyen_mai.min' =>'Giá khuyến mãi phải lớn hơn 0',
            'gia_khuyen_mai.lt' =>'Giá khuyến mãi phải nhỏ hơn giá gốc',
            'mo_ta_ngan.max' =>'Mô tả ngắn không được quá 255 kí tự',
            'so_luong.integer' =>'Số lượng phải là số',
            'so_luong.min' =>'Số lượng không được nhỏ hơn 0',
            'ngay_nhap.required' =>'Bạn phải nhập ngày nhập',
            'ngay_nhap.date' =>'Ngày nhập sai định dạng',
            'danh_muc_id.required' =>'Bạn phải chọn danh mục',
            'danh_muc_id.exists' =>'Bạn phải chọn danh mục ',
        ];
    }
}
