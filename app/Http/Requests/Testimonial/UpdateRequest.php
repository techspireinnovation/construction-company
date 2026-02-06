<?php

namespace App\Http\Requests\Testimonial;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Get testimonial ID from route (supports model binding)
        $id = $this->route('testimonial');

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                // Ensure unique name except for current testimonial
                Rule::unique('testimonials', 'name')->ignore($id),
            ],
            'designation' => 'required|string|max:100',
            'message' => 'required|string',

            // Image is optional on update
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',

            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the name.',
            'name.max' => 'Name cannot exceed 100 characters.',
            'name.unique' => 'This name already exists.',

            'designation.required' => 'Please enter designation.',
            'designation.max' => 'Designation cannot exceed 100 characters.',

            'message.required' => 'Please enter a message.',

            'image.image' => 'Image must be a valid file.',
            'image.mimes' => 'Image must be jpeg, jpg, png, or webp.',
            'image.max' => 'Image size must not exceed 2MB.',
        ];
    }
}
