<?php

namespace App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question' => [
                'required',
                'string',
                'max:255',
                Rule::unique('faqs', 'question'),
            ],
            'answer' => 'required|string',
            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'question.required' => 'Please enter the question.',
            'question.max' => 'Question cannot exceed 255 characters.',
            'question.unique' => 'This question already exists.',
            'answer.required' => 'Please enter the answer.',
        ];
    }
}
