<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserStatusRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'status_id' => 'required|exists:statuses,id',
        ];
    }

    public function messages(): array
    {
        return [
            // 'status_id.required' => 'El estado es obligatorio.',
            // 'status_id.exists' => 'El estado seleccionado no existe.',
        ];
    }
}
