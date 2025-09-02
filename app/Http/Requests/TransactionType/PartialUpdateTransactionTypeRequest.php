<?php

namespace App\Http\Requests\TransactionType;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateTransactionTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|min:5|max:20',
            'color_id' => 'sometimes|numeric|exists:colors,id',
            'icon_id' => 'sometimes|numeric|exists:icons,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El :attribute debe ser en formato de texto.',
            'color_id.numeric' => 'El :attribute debe ser en formato de número.',
            'icon_id.numeric' => 'El :attribute debe ser en formato de número.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'name.max' => 'El :attribute no debe tener más de :max caracteres.',
            'color_id.exists' => 'El :attribute no existe',
            'icon_id.exists' => 'El :attribute no existe',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'color_id' => 'color',
            'icon_id' => 'ícono',
        ];
    }
}
