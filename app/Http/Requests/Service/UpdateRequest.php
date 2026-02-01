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
        // Get the service ID from the route parameter
        $id = $this->route('service');

        return [
            'title'             => ['required', 'string', 'max:100', Rule::unique('services','title')->ignore($id)],
            'short_description' => 'required|string',
            'description'       => 'required|string',
            'image'             => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'banner_image'      => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'status'            => 'nullable|boolean',

            // SEO fields
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string',
            'seo_keywords'      => 'nullable|string', // comma separated
            'seo_image'         => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }
}
