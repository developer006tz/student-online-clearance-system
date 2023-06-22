<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClearStoreRequest extends FormRequest
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
            'clearance_id' => ['required', 'exists:clearances,id'],
            'user_id' => ['required', 'exists:users,id'],
            'role' => ['required', 'max:255', 'string'],
            'comment' => ['required', 'max:255', 'string'],
            'signature' => ['required', 'in:0,1'],
            'date' => ['required', 'date'],
            'status' => ['nullable', 'in:0,1'],
        ];
    }
}
