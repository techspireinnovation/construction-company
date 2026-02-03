<?php

namespace App\Http\Requests\BlogCategory;

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
        $id = $this->route('blog_category');

        return [
            'title' => [
                'required',
                'string',
                'max:100',
                Rule::unique('blog_categories', 'title')->ignore($id),
            ],

            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'nullable|boolean',

            // SEO
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string',
            'seo_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }
}
