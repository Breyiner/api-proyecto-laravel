<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'user_id' => 'required|numeric|exists:users,id',
            'amount' => 'required|numeric|min:100',
            'description' => 'nullable|string|min:10|max:100',
            'transaction_category_id' => 'required|numeric|exists:transaction_categories,id',
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
            // Validaciones required
            'user_id.required' => 'El :attribute es obligatorio',
            'amount.required' => 'El :attribute es obligatorio',
            'transaction_category_id.required' => 'La :attribute es obligatoria',

            // Validaciones de tipo
            'user_id.numeric' => 'El :attribute debe ser numérico',
            'amount.numeric' => 'El :attribute debe ser numérico',
            'transaction_category_id.numeric' => 'La :attribute debe ser numérica',
            'description.string' => 'La :attribute debe ser en formato de texto',

            'description.min' => 'La :attribute debe tener al menos :min caracteres',

            'description.max' => 'La :attribute no debe tener más de :max caracteres',

            // Validaciones de valor mínimo
            'amount.min' => 'El :attribute debe ser de al menos :min',

            // Validaciones de existencia
            'user_id.exists' => 'El :attribute seleccionado no existe',
            'transaction_category_id.exists' => 'La :attribute seleccionada no existe',
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
            'user_id' => 'usuario',
            'amount' => 'monto',
            'description' => 'descripción',
            'transaction_category_id' => 'categoría de transacción',
        ];
    }
}
