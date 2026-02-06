<?php

namespace App\Http\Requests\BlogCategory;

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
            'title' => 'required|string|max:100|unique:blog_categories,title',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'nullable|boolean',

            // SEO
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string',
            'seo_image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }
}
