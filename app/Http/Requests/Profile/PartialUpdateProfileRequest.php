<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateProfileRequest extends FormRequest
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
            'first_name' => 'sometimes|string|min:3|max:50',
            'last_name' => 'sometimes|string|min:3|max:50',
            'city_id' => 'sometimes|exists:cities,id',
            'gender_id' => 'sometimes|exists:genders,id',
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
            'first_name.string' => 'El :attribute debe ser en formato de texto.',
            'last_name.string' => 'El :attribute debe ser en formato de texto.',

            'first_name.min' => 'El :attribute debe tener al menos :min caracteres',
            'last_name.min' => 'El :attribute debe tener al menos :min caracteres',

            'first_name.max' => 'El :attribute no debe tener más de :max caracteres',
            'last_name.max' => 'El :attribute no debe tener más de :max caracteres',

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
        ];
    }
}
