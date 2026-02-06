<?php

namespace App\Http\Requests\Service;

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
        // Get service ID from route (supports model binding)
        $id = $this->route('service');

        return [
            'title' => [
                'required',
                'string',
                'max:100',
                Rule::unique('services', 'title')->ignore($id),
            ],

            'short_description' => 'required|string',
            'description' => 'required|string',
            'long_description' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',

            'status' => 'nullable|boolean',

            // SEO fields (optional on update)
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string', // comma separated
            'seo_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            // Service fields
            'title.required' => 'Please enter a service title.',
            'title.unique' => 'This service title already exists.',
            'title.max' => 'Service title must not exceed 100 characters.',

            'short_description.required' => 'Please provide a short description.',
            'description.required' => 'Please provide a detailed description.',

            'image.image' => 'Service image must be a valid image file.',
            'image.mimes' => 'Service image must be a JPG, PNG, or WEBP file.',
            'image.max' => 'Service image size must not exceed 2MB.',

            'banner_image.image' => 'Banner image must be a valid image file.',
            'banner_image.mimes' => 'Banner image must be a JPG, PNG, or WEBP file.',
            'banner_image.max' => 'Banner image size must not exceed 4MB.',

            // SEO fields
            'seo_title.max' => 'SEO title must not exceed 255 characters.',

            'seo_image.image' => 'SEO image must be a valid image file.',
            'seo_image.mimes' => 'SEO image must be a JPG, PNG, or WEBP file.',
            'seo_image.max' => 'SEO image size must not exceed 2MB.',
        ];
    }
}
