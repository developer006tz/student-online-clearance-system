<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClearanceUpdateRequest extends FormRequest
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
            'student_id' => ['required', 'exists:students,id'],
            'name' => ['required', 'max:255', 'string'],
            'registration_number' => ['required', 'max:255', 'string'],
            // 'block_number' => ['required', 'max:255', 'string'],
            // 'room_number' => ['required', 'max:255', 'string'],
            'level' => ['required', 'max:255', 'string'],
            'hall-wadern' => ['nullable', 'in:0,1'],
            'librarian-udsm' => ['nullable', 'in:0,1'],
            'librarian-cse' => ['nullable', 'in:0,1'],
            'coordinator' => ['nullable', 'in:0,1'],
            'principal' => ['nullable', 'in:0,1'],
            'smart-card' => ['nullable', 'in:0,1'],
        ];
    }
}
