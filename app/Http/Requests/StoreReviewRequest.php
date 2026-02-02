<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'booking_id' => 'required|exists:bookings,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
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
            'booking_id.required' => 'Không tìm thấy thông tin đặt xe.',
            'booking_id.exists' => 'Đơn đặt xe không tồn tại.',
            'vehicle_id.required' => 'Không tìm thấy thông tin xe.',
            'vehicle_id.exists' => 'Xe không tồn tại trong hệ thống.',
            'rating.required' => 'Vui lòng chọn đánh giá sao.',
            'rating.integer' => 'Đánh giá phải là số nguyên.',
            'rating.min' => 'Đánh giá tối thiểu là 1 sao.',
            'rating.max' => 'Đánh giá tối đa là 5 sao.',
            'comment.max' => 'Nhận xét không được vượt quá 500 ký tự.',
        ];
    }
}
