<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:20'
        ];
    }

    /**

     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio',
            'last_name.required' => 'El :attribute es obligatorio',
            'email.required' => 'El :attribute es obligatorio',
            'password.required'=>'La :attribute es obligatoria',

            'name.min' => 'El :attribute debe tener al menos :min caracteres',
            'last_name.min' => 'El :attribute debe tener al menos :min caracteres',
            'password.min' => 'La :attribute debe tener al menos :min caracteres.',

            'name.max' => 'El :attribute no debe tener más de :max caracteres',
            'last_name.max' => 'El :attribute no debe tener más de :max caracteres',
            'password.max' => 'La attribute no debe tener más de :max caracteres',

            'email.unique'   => 'Este :attribute ya está registrado en el sistema.',
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
            'name' => 'nombre',
            'last_name' => 'apellido',
            'email' => 'correo',
            'password' => 'contraseña'
        ];
    }
}
