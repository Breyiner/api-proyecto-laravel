<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user_id');

        return [
            'email' => 'required|email|unique:users,email,'.$userId,
            'password' => 'required|min:8|max:20',
            'role_id' => 'required|exists:roles,id',
            // 'status_id' => 'required|exists:statuses,id',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'El :attribute no tiene un formato válido.',
            'email.unique' => 'Este :attribute ya está registrado.',
            'password.min' => 'La :attribute debe tener al menos :min caracteres.',
            'password.max' => 'La :attribute no debe tener más de :max caracteres.',
            'role_id.required' => 'El :attribute es obligatorio.',
            'role_id.exists' => 'El :attribute seleccionado no existe.',
            // 'status_id.required' => 'El :attribute es obligatorio.',
            // 'status_id.exists' => 'El :attribute seleccionado no existe.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'email' => 'correo',
            'password' => 'contraseña',
            'role_id' => 'rol',
            'status_id' => 'estado',
        ];
    }
}
