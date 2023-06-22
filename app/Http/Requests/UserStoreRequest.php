<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'role' => [
                'required',
                'in:student,hall-wadern,librarian-udsm,librarian-cse,principle,smart-card',
            ],
            'username' => ['required', 'max:255', 'string'],
            'password' => ['required'],
            'image' => ['nullable', 'image', 'max:1024'],
            'roles' => 'array',
        ];
    }
}