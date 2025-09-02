<?php

namespace App\Http\Requests\Goal;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|numeric|exists:users,id',
            'name' => 'required|string|min:5|max:30',
            'target_amount' => 'required|numeric|min:100',
            'description' => 'nullable|string|min:10|max:100',
            'due_date' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'El :attribute es obligatorio',
            'name.required' => 'El :attribute es obligatorio',
            'target_amount.required' => 'El :attribute es obligatorio',
            'due_date.required' => 'La :attribute es obligatoria',

            'user_id.numeric' => 'El :attribute debe ser numérico',
            'name.string' => 'El :attribute debe ser en formato de texto',
            'target_amount.numeric' => 'El :attribute debe ser numérico',
            'description.string' => 'La :attribute debe ser en formato de texto',

            'name.min' => 'El :attribute debe tener al menos :min caracteres',
            'description.min' => 'La :attribute debe tener al menos :min caracteres',
            'name.max' => 'El :attribute no debe tener más de :max caracteres',
            'description.max' => 'La :attribute no debe tener más de :max caracteres',

            'target_amount.min' => 'El :attribute debe ser de al menos :min',

            'user_id.exists' => 'El :attribute seleccionado no existe',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'usuario',
            'name' => 'nombre',
            'target_amount' => 'monto objetivo',
            'description' => 'descripción',
            'due_date' => 'fecha límite',
        ];
    }
}
