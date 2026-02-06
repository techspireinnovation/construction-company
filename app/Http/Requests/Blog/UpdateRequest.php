<?php

namespace App\Http\Requests\Blog;

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
        $id = $this->route('blog');

        return [
            'title' => [
                'required',
                'string',
                'max:100',
                Rule::unique('blogs', 'title')->ignore($id),
            ],
            'short_description' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'written_by' => 'nullable|string|max:100',
            'status' => 'nullable|boolean',

            // SEO optional for update
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string',
            'seo_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }
}
