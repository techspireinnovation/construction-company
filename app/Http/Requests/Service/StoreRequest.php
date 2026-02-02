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
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string', // comma separated
            'seo_image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
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

            'image.required' => 'Please upload a service image.',
            'image.image' => 'Service image must be a valid image file.',
            'image.mimes' => 'Service image must be a JPG, PNG, or WEBP file.',
            'image.max' => 'Service image size must not exceed 2MB.',

            'banner_image.image' => 'Banner image must be a valid image file.',
            'banner_image.mimes' => 'Banner image must be a JPG, PNG, or WEBP file.',
            'banner_image.max' => 'Banner image size must not exceed 4MB.',

            // SEO fields
            'seo_title.required' => 'Please enter an SEO title.',
            'seo_title.max' => 'SEO title must not exceed 255 characters.',

            'seo_description.required' => 'Please enter an SEO description.',
            'seo_keywords.required' => 'Please provide SEO keywords.',

            'seo_image.required' => 'Please upload an SEO image.',
            'seo_image.image' => 'SEO image must be a valid image file.',
            'seo_image.mimes' => 'SEO image must be a JPG, PNG, or WEBP file.',
            'seo_image.max' => 'SEO image size must not exceed 2MB.',
        ];
    }

}
