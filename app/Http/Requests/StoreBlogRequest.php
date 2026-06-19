<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'image' => 'Ảnh sản phẩm',
            'description' => 'Nội dung',
        ];
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'image' => ':attribute phải là hình ảnh',
            'max' => ':attribute không được vượt quá :max KB',
        ];
    }
}
