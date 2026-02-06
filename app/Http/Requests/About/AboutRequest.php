<?php

namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
        ];

        // Mission & Vision are arrays of image + content
        $rules['mission'] = 'required|array|min:1';
        $rules['mission.0.content'] = 'required|string';

        // Image is not required when editing - only validate if a file is uploaded
        $rules['mission.0.image'] = 'nullable|sometimes|image|mimes:jpeg,jpg,png,webp|max:5120';

        $rules['vision'] = 'required|array|min:1';
        $rules['vision.0.content'] = 'required|string';

        // Image is not required when editing - only validate if a file is uploaded
        $rules['vision.0.image'] = 'nullable|sometimes|image|mimes:jpeg,jpg,png,webp|max:5120';

        // Stats validation
        $rules['stats.years_of_experience'] = 'required|integer|min:0';
        $rules['stats.no_of_projects'] = 'required|integer|min:0';
        $rules['stats.no_of_employees'] = 'required|integer|min:0';
        $rules['stats.no_of_satisfied_clients'] = 'required|integer|min:0';

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'description.required' => 'Description is required.',
            'mission.required' => 'Mission data is required.',
            'vision.required' => 'Vision data is required.',
            'mission.0.content.required' => 'Mission content is required.',
            'vision.0.content.required' => 'Vision content is required.',
            'mission.0.image.image' => 'Mission image must be a valid image file.',
            'vision.0.image.image' => 'Vision image must be a valid image file.',
            'stats.years_of_experience.required' => 'Years of experience is required.',
            'stats.no_of_projects.required' => 'Number of projects is required.',
            'stats.no_of_employees.required' => 'Number of employees is required.',
            'stats.no_of_satisfied_clients.required' => 'Number of satisfied clients is required.',
        ];
    }

    public function attributes(): array
    {
        return [
            'mission.0.image' => 'mission image',
            'mission.0.content' => 'mission content',
            'vision.0.image' => 'vision image',
            'vision.0.content' => 'vision content',
            'stats.years_of_experience' => 'years of experience',
            'stats.no_of_projects' => 'number of projects',
            'stats.no_of_employees' => 'number of employees',
            'stats.no_of_satisfied_clients' => 'number of satisfied clients',
        ];
    }
}