<?php

namespace App\Http\Requests\GoalTransaction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoalTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:100',
            'description' => 'required|string|min:5|max:255',
            'transaction_type_id' => 'required|numeric|exists:goal_transaction_types,id',
        ];
    }

    public function messages(): array
    {
        return [

            // Required
            'amount.required' => 'El monto es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'transaction_type_id.required' => 'El tipo de transacción es obligatorio.',

            // Tipos
            'amount.numeric' => 'El monto debe ser numérico.',
            'description.string' => 'La descripción debe ser texto.',
            'transaction_type_id.numeric' => 'El tipo de transacción debe ser numérico.',

            // Longitud/valor
            'amount.min' => 'El monto debe ser de al menos 100.',
            'description.min' => 'La descripción debe tener al menos :min caracteres.',
            'description.max' => 'La descripción no debe superar :max caracteres.',

            // Existencia
            'transaction_type_id.exists' => 'El tipo de transacción seleccionado no existe.',
        ];
    }

    public function attributes(): array
    {
        return [
            'amount' => 'monto',
            'description' => 'descripción',
            'transaction_type_id' => 'tipo de transacción',
        ];
    }
}
