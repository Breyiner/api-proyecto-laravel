<?php

namespace App\Http\Requests\TransactionCategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:20',
            'transaction_type_id' => 'required|exists:transaction_types,id',
            'icon_id' => 'required|numeric|exists:icons,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'transaction_type_id.required' => 'La :attribute es obligatoria.',
            'icon_id.required' => 'El :attribute es obligatorio.',
            'name.string' => 'El :attribute debe ser en formato de texto.',
            'icon_id.numeric' => 'El :attribute debe ser un número.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'name.max' => 'El :attribute no debe tener más de :max caracteres.',
            'transaction_type_id.exists' => 'El :attribute seleccionado no existe.',
            'icon_id.exists' => 'El :attribute seleccionado no existe.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'transaction_type_id' => 'tipo de movimiento',
            'icon_id' => 'icono',
        ];
    }
}
