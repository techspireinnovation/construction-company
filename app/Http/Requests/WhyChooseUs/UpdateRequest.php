<?php

namespace App\Http\Requests\WhyChooseUs;

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
        $id = $this->route('why_choose_us');

        return [
            'title' => [
                'required',
                'string',
                'max:100',
            ],
            'content' => 'required|string',
            'icon' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title.',
            'title.max' => 'Title cannot exceed 100 characters.',
            'content.required' => 'Please enter content.',
            'icon.image' => 'Icon must be an image file.',
            'icon.mimes' => 'Icon must be jpeg, jpg, png, gif, svg, or webp.',
            'icon.max' => 'Icon size must not exceed 2MB.',
        ];
    }
}
