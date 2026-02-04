<?php

namespace App\Http\Requests\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => 'required|string|max:100',
            'primary_mobile_no' => 'required|string|max:10',
            'secondary_mobile_no' => 'nullable|string|max:10',
            'primary_email' => 'required|email|max:100',
            'secondary_email' => 'nullable|email|max:100',
            'address' => 'required|string',
            'embedded_map' => 'required|string',
            'logo_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'fav_icon_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:1024',
            'footer_text' => 'required|string|max:255',
            'instagram_link' => 'nullable|url',
            'facebook_link' => 'nullable|url',
            'whatsapp_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            'company_name.required' => 'Company name is required.',
            'primary_mobile_no.required' => 'Primary mobile number is required.',
            'primary_email.required' => 'Primary email is required.',
            'logo_image.image' => 'Logo must be a valid image file.',
            'logo_image.mimes' => 'Logo must be jpeg, jpg, png, or webp.',
            'logo_image.max' => 'Logo size must not exceed 2MB.',
            'fav_icon_image.image' => 'Favicon must be a valid image file.',
            'fav_icon_image.mimes' => 'Favicon must be PNG or ICO.',
            'fav_icon_image.max' => 'Favicon size must not exceed 1MB.',
        ];
    }
}
