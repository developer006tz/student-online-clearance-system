<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->user),
                'email',
            ],
            'role' => [
                'required',
                'in:student,hall-wadern,librarian-udsm,librarian-cse,principal,smart-card',
                'unique:users,role',
            ],
            'username' => ['required', 'max:255', 'string'],
            'password' => ['nullable'],
            'image' => ['nullable', 'image', 'max:9999'],
            'roles' => 'array',
        ];
    }
}
