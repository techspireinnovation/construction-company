<?php

namespace App\Http\Requests\WhyChooseUs;

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
            'title' => 'required|string|max:100|unique:why_choose_us,title',
            'content' => 'required|string',
            'icon' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title.',
            'title.max' => 'Title cannot exceed 100 characters.',
            'title.unique' => 'This title already exists.',
            'content.required' => 'Please enter content.',
            'icon.required' => 'Please upload an icon image.',
            'icon.image' => 'Icon must be an image file.',
            'icon.mimes' => 'Icon must be jpeg, jpg, png, or webp.',
            'icon.max' => 'Icon size must not exceed 2MB.',
        ];
    }
}
