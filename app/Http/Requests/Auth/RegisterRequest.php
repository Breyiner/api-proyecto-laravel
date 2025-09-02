<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'city_id' => 'required|exists:cities,id',
            'gender_id' => 'required|exists:genders,id',
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
            'first_name.required' => 'El :attribute es obligatorio',
            'last_name.required' => 'El :attribute es obligatorio',
            'email.required' => 'El :attribute es obligatorio',
            'password.required'=>'La :attribute es obligatoria',

            'first_name.min' => 'El :attribute debe tener al menos :min caracteres',
            'last_name.min' => 'El :attribute debe tener al menos :min caracteres',
            'password.min' => 'La :attribute debe tener al menos :min caracteres.',

            'first_name.max' => 'El :attribute no debe tener más de :max caracteres',
            'last_name.max' => 'El :attribute no debe tener más de :max caracteres',
            'password.max' => 'La attribute no debe tener más de :max caracteres',

            'email.unique'   => 'Este :attribute ya está registrado en el sistema.',

            'city_id.required'=>'La :attribute es obligatoria',
            'gender_id.required'=>'El :attribute es obligatorio',
            'city_id.exists' => 'La :attribute seleccionada no existe.',
            'gender_id.exists' => 'El :attribute seleccionado no existe.',

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
            'first_name' => 'nombre',
            'last_name' => 'apellido',
            'city_id' => 'ciudad',
            'gender_id' => 'género',
            'email' => 'correo',
            'password' => 'contraseña'
        ];
    }
}
