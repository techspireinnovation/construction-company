<?php

namespace App\Http\Requests\Partner;

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
        $id = $this->route('partner');

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('partners', 'name')->ignore($id),
            ],
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the partner name.',
            'name.max' => 'Name cannot exceed 100 characters.',
            'name.unique' => 'This name already exists.',
            'image.image' => 'Image must be valid.',
            'image.mimes' => 'Image must be jpeg, jpg, png, or webp.',
            'image.max' => 'Image size must not exceed 2MB.',
        ];
    }
}
