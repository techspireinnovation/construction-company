<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow all users to submit
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'mobile' => 'required|string|max:25|regex:/^\d{10}$/',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.max' => 'Name must not exceed 100 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email must not exceed 150 characters.',
            'mobile.required' => 'Mobile number is required.',
            'mobile.max' => 'Mobile number must not exceed 25 digits.',
            'mobile.regex' => 'Mobile number must be exactly 10 digits.',
            'subject.required' => 'Subject is required.',
            'subject.max' => 'Subject must not exceed 150 characters.',
            'message.required' => 'Message is required.',
            'message.max' => 'Message must not exceed 2000 characters.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'subject' => 'Subject',
            'message' => 'Message',
        ];
    }
}
