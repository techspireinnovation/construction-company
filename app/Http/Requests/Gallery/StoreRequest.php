<?php

namespace App\Http\Requests\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter gallery title.',
            'images.required' => 'Please upload at least one image.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Images must be jpeg, jpg, png, or webp.',
            'images.*.max' => 'Each image must not exceed 2MB.',
        ];
    }
}
