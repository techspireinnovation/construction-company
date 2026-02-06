<?php

namespace App\Http\Requests\Team;

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
        $id = $this->route('team');

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('teams', 'name')->ignore($id),
            ],
            'designation' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'instagram_link' => 'nullable|url',
            'facebook_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the name.',
            'name.max' => 'Name cannot exceed 100 characters.',
            'name.unique' => 'This name already exists.',
            'designation.required' => 'Please enter the designation.',
            'designation.max' => 'Designation cannot exceed 100 characters.',
            'image.image' => 'Image must be a valid file.',
            'image.mimes' => 'Image must be jpeg, jpg, png, or webp.',
            'image.max' => 'Image size must not exceed 2MB.',
            'instagram_link.url' => 'Instagram link must be a valid URL.',
            'facebook_link.url' => 'Facebook link must be a valid URL.',
            'linkedin_link.url' => 'LinkedIn link must be a valid URL.',
        ];
    }
}
