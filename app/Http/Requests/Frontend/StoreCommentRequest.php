<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Middleware auth:member đã chặn, nhưng check thêm cho chắc
        return $this->user('member') !== null;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|string|min:1|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Vui lòng nhập nội dung bình luận!',
            'content.min' => 'Nội dung bình luận quá ngắn!',
            'content.max' => 'Nội dung bình luận không được vượt quá 1000 ký tự!',
        ];
    }

    // Trả về JSON khi authorize() = false (chưa đăng nhập)
    protected function failedAuthorization()
    {
        throw new \Illuminate\Auth\Access\AuthorizationException(
            'Vui lòng đăng nhập để bình luận!'
        );
    }
}