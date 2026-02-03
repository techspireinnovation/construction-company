<?php

namespace App\Http\Requests\PortfolioCategory;

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
            'title' => 'required|string|max:100|unique:portfolio_categories,title',
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
