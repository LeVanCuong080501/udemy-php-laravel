<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên người dùng',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'id_country' => 'Quốc tịch',
            'avatar' => 'Ảnh đại diện',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'id_country' => 'nullable|exists:countries,id',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute.',
            'email' => ':attribute không hợp lệ.',
            'unique' => ':attribute đã được sử dụng.',
            'min' => ':attribute tối thiểu 6 ký tự.',
            'confirmed' => 'Xác nhận :attribute không khớp.',
            'image' => 'File phải là hình ảnh.',
            'mimes' => 'Ảnh chỉ chấp nhận jpg, jpeg, png, gif.',
            'max' => 'Ảnh tối đa 2MB.',
        ];
    }
}
