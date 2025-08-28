<?php

namespace App\Http\Requests\GoalTransaction;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateGoalTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'sometimes|numeric|min:100|decimal:2',
            'description' => 'sometimes|string|min:5|max:255',
            'transaction_type_id' => 'sometimes|numeric|exists:goal_transaction_types,id',
        ];
    }

    public function messages(): array
    {
        return [

            // Tipos
            'amount.numeric' => 'El monto debe ser numérico.',
            'description.string' => 'La descripción debe ser texto.',
            'transaction_type_id.numeric' => 'El tipo de transacción debe ser numérico.',

            // Longitud/valor
            'amount.min' => 'El monto debe ser de al menos 100.',
            'description.min' => 'La descripción debe tener al menos :min caracteres.',
            'description.max' => 'La descripción no debe superar :max caracteres.',

            // Decimales
            'amount.decimal' => 'El monto debe tener exactamente 2 decimales.',

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
