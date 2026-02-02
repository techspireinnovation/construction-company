<?php

namespace App\Http\Requests\Testimonial;

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
            'name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'message' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the name.',
            'name.max' => 'Name cannot exceed 100 characters.',
            'designation.required' => 'Please enter designation.',
            'designation.max' => 'Designation cannot exceed 100 characters.',
            'message.required' => 'Please enter a message.',
            'image.required' => 'Please upload a testimonial image.',
            'image.image' => 'Image must be a valid file.',
            'image.mimes' => 'Image must be jpeg, jpg, png, or webp.',
            'image.max' => 'Image size must not exceed 2MB.',
        ];
    }
}
