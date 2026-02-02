<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'master']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'type' => 'required|in:Sedan,SUV,Hatchback,Luxury,Limousine',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'location' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên xe không được để trống.',
            'name.max' => 'Tên xe không được vượt quá 255 ký tự.',
            'brand_id.required' => 'Vui lòng chọn hãng xe.',
            'brand_id.exists' => 'Hãng xe không tồn tại.',
            'type.required' => 'Vui lòng chọn loại xe.',
            'type.in' => 'Loại xe không hợp lệ.',
            'price.required' => 'Giá thuê không được để trống.',
            'price.numeric' => 'Giá thuê phải là số.',
            'price.min' => 'Giá thuê phải lớn hơn 0.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, webp.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'location.max' => 'Địa điểm không được vượt quá 255 ký tự.',
        ];
    }
}
