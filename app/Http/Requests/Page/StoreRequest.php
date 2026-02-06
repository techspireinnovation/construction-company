<?php

namespace App\Http\Requests\Page;

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
            'type' => 'required|integer|unique:pages,type',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',

            // SEO
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string',
            'seo_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Please select a page type.',
            'type.integer' => 'The page type must be a valid number.',
            'type.unique' => 'The selected page type has already been used.',

            'banner_image.image' => 'The banner must be an image.',
            'banner_image.mimes' => 'The banner image must be a file of type: jpg, jpeg, png, webp.',
            'banner_image.max' => 'The banner image must not be greater than 2MB.',

            'status.boolean' => 'Invalid status value.',

            'seo_title.required' => 'SEO title is required.',
            'seo_title.string' => 'SEO title must be a valid text.',
            'seo_title.max' => 'SEO title cannot exceed 255 characters.',

            'seo_description.required' => 'SEO description is required.',
            'seo_description.string' => 'SEO description must be valid text.',

            'seo_keywords.required' => 'SEO keywords are required.',
            'seo_keywords.string' => 'SEO keywords must be valid text.',

            'seo_image.required' => 'SEO image is required.',
            'seo_image.image' => 'SEO image must be an image file.',
            'seo_image.mimes' => 'SEO image must be a file of type: jpg, jpeg, png, webp.',
            'seo_image.max' => 'SEO image must not be larger than 2MB.',
        ];
    }
}
