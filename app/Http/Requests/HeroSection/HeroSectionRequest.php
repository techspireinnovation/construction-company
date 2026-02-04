<?php

namespace App\Http\Requests\HeroSection;

use Illuminate\Foundation\Http\FormRequest;

class HeroSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // In HeroSectionRequest.php, update the rules method:
    public function rules(): array
    {
        $rules = [
            'type' => 'required|in:1,2',
        ];

        $type = $this->input('type');

        if ($type == 2) {
            // Video type
            $rules['hero_with_video'] = 'required|array';
            $rules['hero_with_video.title'] = 'required|string|max:255';
            $rules['hero_with_video.content'] = 'nullable|string';
            $rules['hero_with_video.embed'] = 'required|string';

            // Explicitly ignore image fields when type is video
            $rules['hero_with_images'] = 'nullable';
            $rules['hero_with_images.*'] = 'nullable';
        } else {
            // Image type
            $rules['hero_with_images'] = 'required|array|min:1';
            $rules['hero_with_images.*.title'] = 'required|string|max:255';
            $rules['hero_with_images.*.content'] = 'nullable|string';

            // Image is not required when editing - only validate if a file is uploaded
            $rules['hero_with_images.*.image'] = 'nullable|sometimes|image|mimes:jpeg,jpg,png,webp|max:5120';

            // Explicitly ignore video fields when type is image
            $rules['hero_with_video'] = 'nullable';
        }

        return $rules;
    }
    public function messages(): array
    {
        return [
            'type.required' => 'Hero type is required.',
            'type.in' => 'Invalid hero type selected.',
            'hero_with_video.required' => 'Video data is required when hero type is video.',
            'hero_with_video.title.required' => 'Video title is required.',
            'hero_with_video.embed.required' => 'Video embed code is required.',
            'hero_with_images.required' => 'At least one slide is required when hero type is images.',
            'hero_with_images.min' => 'At least one slide is required.',
            'hero_with_images.*.title.required' => 'Each slide must have a title.',
            'hero_with_images.*.image.image' => 'The uploaded file must be an image.',
            'hero_with_images.*.image.mimes' => 'Only JPEG, JPG, PNG, and WebP images are allowed.',
            'hero_with_images.*.image.max' => 'The image size must not exceed 5MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'hero_with_video.title' => 'video title',
            'hero_with_video.content' => 'video content',
            'hero_with_video.embed' => 'video embed code',
            'hero_with_images.*.title' => 'slide title',
            'hero_with_images.*.content' => 'slide content',
            'hero_with_images.*.image' => 'slide image',
        ];
    }
}