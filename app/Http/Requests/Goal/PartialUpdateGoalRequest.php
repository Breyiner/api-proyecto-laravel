<?php

namespace App\Http\Requests\Goal;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateGoalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|min:5|max:30',
            'target_amount' => 'sometimes|numeric|min:100|decimal:2',
            'description' => 'nullable|string|min:10|max:100',
            'due_date' => 'sometimes|date',
            'completed' => 'sometimes|boolean',
            'status_id' => 'sometimes|numeric|exists:statuses,id',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'El :attribute debe ser en formato de texto',
            'target_amount.numeric' => 'El :attribute debe ser numérico',
            'description.string' => 'La :attribute debe ser en formato de texto',
            'completed.boolean' => 'El :attribute debe ser verdadero o falso',
            'status_id.numeric' => 'El :attribute debe ser numérico',

            'name.min' => 'El :attribute debe tener al menos :min caracteres',
            'description.min' => 'La :attribute debe tener al menos :min caracteres',
            'name.max' => 'El :attribute no debe tener más de :max caracteres',
            'description.max' => 'La :attribute no debe tener más de :max caracteres',

            'target_amount.min' => 'El :attribute debe ser de al menos :min',
            'target_amount.decimal' => 'El :attribute debe tener máximo :decimal decimales',

            'status_id.exists' => 'El :attribute seleccionado no existe',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'target_amount' => 'monto objetivo',
            'description' => 'descripción',
            'due_date' => 'fecha límite',
            'completed' => 'completado',
            'status_id' => 'estado',
        ];
    }
}
