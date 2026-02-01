<?php

namespace App\Http\Requests\Service;

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
            'title' => 'required|string|max:100|unique:services,title',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'status' => 'nullable|boolean',

            // SEO fields
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string', // comma separated
            'seo_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Service title is required.',
            'title.unique' => 'This service title is already taken.',
            'short_description.required' => 'Short description is required.',
            'description.required' => 'Description is required.',
            'image.required' => 'Service image is required.',
            'image.image' => 'The uploaded file must be an image.',
            'banner_image.image' => 'The uploaded banner must be an image.',

            // SEO messages
            'seo_image.image' => 'The SEO image must be an image file.',
        ];
    }
}
