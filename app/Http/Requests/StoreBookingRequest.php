<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'total_price' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:500',
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
            'vehicle_id.required' => 'Vui lòng chọn xe cần thuê.',
            'vehicle_id.exists' => 'Xe bạn chọn không tồn tại trong hệ thống.',
            'start_date.required' => 'Vui lòng chọn ngày nhận xe.',
            'start_date.after' => 'Ngày nhận xe phải sau thời điểm hiện tại.',
            'end_date.required' => 'Vui lòng chọn ngày trả xe.',
            'end_date.after' => 'Ngày trả xe phải sau ngày nhận xe.',
            'total_price.required' => 'Giá thuê không được để trống.',
            'total_price.numeric' => 'Giá thuê phải là số.',
            'total_price.min' => 'Giá thuê phải lớn hơn 0.',
            'note.max' => 'Ghi chú không được vượt quá 500 ký tự.',
        ];
    }
}
