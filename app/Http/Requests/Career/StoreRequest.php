<?php

namespace App\Http\Requests\Career;

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
            'job_title' => 'required|string|max:100|unique:careers,job_title',
            'employment_type' => 'required|integer|in:0,1',
            'experience_required' => 'nullable|string|max:100',
            'education_level' => 'required|integer|between:0,7',
            'salary_range' => 'required|string|max:100',
            'shift_duration' => 'required|string|max:100',
            'short_summery' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'required|array|min:1',
            'requirements.*' => 'required|string|distinct',
            'responsibilities' => 'required|array|min:1',
            'responsibilities.*' => 'required|string|distinct',
            'application_deadline' => 'required|date|after_or_equal:today',
            'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'status' => 'nullable|boolean',

            // SEO
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string',
            'seo_image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }

    /**
     * Prepare the data for validation.
     * Convert JSON strings to arrays and remove duplicates before validation
     */
    protected function prepareForValidation()
    {
        // Convert requirements JSON string to array and remove duplicates
        if ($this->has('requirements')) {
            $requirements = $this->requirements;

            if (is_string($requirements)) {
                $requirements = json_decode($requirements, true) ?? [];
            }

            if (is_array($requirements)) {
                // Trim, filter empty, and remove duplicates (case insensitive)
                $requirements = array_map('trim', $requirements);
                $requirements = array_filter($requirements);
                $requirements = array_unique(array_map('strtolower', $requirements));
                $requirements = array_values($requirements); // Re-index array
            } else {
                $requirements = [];
            }

            $this->merge(['requirements' => $requirements]);
        }

        // Convert responsibilities JSON string to array and remove duplicates
        if ($this->has('responsibilities')) {
            $responsibilities = $this->responsibilities;

            if (is_string($responsibilities)) {
                $responsibilities = json_decode($responsibilities, true) ?? [];
            }

            if (is_array($responsibilities)) {
                // Trim, filter empty, and remove duplicates (case insensitive)
                $responsibilities = array_map('trim', $responsibilities);
                $responsibilities = array_filter($responsibilities);
                $responsibilities = array_unique(array_map('strtolower', $responsibilities));
                $responsibilities = array_values($responsibilities); // Re-index array
            } else {
                $responsibilities = [];
            }

            $this->merge(['responsibilities' => $responsibilities]);
        }
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'requirements.required' => 'At least one requirement is required.',
            'requirements.array' => 'Requirements must be a valid array.',
            'requirements.min' => 'At least one requirement is required.',
            'requirements.*.distinct' => 'Duplicate requirements are not allowed.',
            'requirements.*.required' => 'Requirement cannot be empty.',

            'responsibilities.required' => 'At least one responsibility is required.',
            'responsibilities.array' => 'Responsibilities must be a valid array.',
            'responsibilities.min' => 'At least one responsibility is required.',
            'responsibilities.*.distinct' => 'Duplicate responsibilities are not allowed.',
            'responsibilities.*.required' => 'Responsibility cannot be empty.',
        ];
    }
}