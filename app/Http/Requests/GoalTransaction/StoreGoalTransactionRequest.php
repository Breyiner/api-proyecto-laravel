<?php

namespace App\Http\Requests\GoalTransaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoalTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'goal_id' => 'required|numeric|exists:goals,id',
            'amount' => 'required|numeric|min:100|decimal:2',
            'description' => 'required|string|min:5|max:255',
            'transaction_type_id' => 'required|numeric|exists:goal_transaction_types,id',
        ];
    }

    public function messages(): array
    {
        return [
            'goal_id.required' => 'El :attribute es obligatorio',
            'amount.required' => 'El :attribute es obligatorio',
            'description.required' => 'La :attribute es obligatoria',
            'transaction_type_id.required' => 'El :attribute es obligatorio',

            'goal_id.exists' => 'El :attribute seleccionado no existe',
            'transaction_type_id.exists' => 'El :attribute seleccionado no existe',
        ];
    }

    public function attributes(): array
    {
        return [
            'goal_id' => 'objetivo',
            'amount' => 'monto',
            'description' => 'descripción',
            'transaction_type_id' => 'tipo de transacción',
        ];
    }
}
