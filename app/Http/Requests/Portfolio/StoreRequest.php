<?php

namespace App\Http\Requests\Portfolio;

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
            'title' => 'required|string|max:100|unique:portfolios,title',
            'portfolio_category_id' => 'required|integer|exists:portfolio_categories,id',
            'partner_id' => 'required|integer|exists:partners,id',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',

            'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'project_status' => 'nullable|in:0,1,2',
            'status' => 'nullable|boolean',

            // SEO fields
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string',
            'seo_image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'images.required' => 'Please upload at least one portfolio image.',
            'images.*.image' => 'Each file must be an image (jpeg, png, webp).',
        ];
    }

}
