<?php

namespace App\Http\Requests\PortfolioCategory;

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
        $id = $this->route('portfolio_category');

        return [
            'title' => [
                'required',
                'string',
                'max:100',
                Rule::unique('portfolio_categories', 'title')->ignore($id),
            ],
            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter category title.',
            'title.max' => 'Title cannot exceed 100 characters.',
            'title.unique' => 'This title already exists.',
        ];
    }
}
