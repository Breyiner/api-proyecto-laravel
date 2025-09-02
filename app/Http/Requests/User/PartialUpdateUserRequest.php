<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateUserRequest extends FormRequest
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
            'email' => 'sometimes|email|unique:users,email,'.$userId,
            'password' => 'sometimes|min:8|max:20',
            'status_id' => 'sometimes|exists:statuses,id',
            'role_id' => 'sometimes|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'El :attribute no tiene un formato válido.',
            'email.unique' => 'Este :attribute ya está registrado.',
            'password.min' => 'La :attribute debe tener al menos :min caracteres.',
            'password.max' => 'La :attribute no debe tener más de :max caracteres.',
            'status_id.exists' => 'El :attribute seleccionado no existe.',
            'role_id.exists' => 'El :attribute seleccionado no existe.',
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
            'status_id' => 'estado',
            'role_id' => 'rol',
        ];
    }
}
