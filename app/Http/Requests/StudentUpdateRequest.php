<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'id_number' => ['required', 'max:255', 'string'],
            'level' => ['required', 'in:certificate,diploma'],
            // 'block_number' => ['required', 'max:255', 'string'],
            // 'room_number' => ['required', 'max:255', 'string'],
        ];
    }
}
