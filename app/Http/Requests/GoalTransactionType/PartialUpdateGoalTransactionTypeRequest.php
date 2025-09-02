<?php

namespace App\Http\Requests\GoalTransactionType;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateGoalTransactionTypeRequest extends FormRequest
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
     */
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
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'name.max' => 'El :attribute no debe tener más de :max caracteres.',
            'color_id.numeric' => 'El :attribute debe ser en formato de número.',
            'color_id.exists' => 'El :attribute no existe.',
            'icon_id.numeric' => 'El :attribute debe ser en formato de número.',
            'icon_id.exists' => 'El :attribute no existe.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'color_id' => 'color',
            'icon_id' => 'icono',
        ];
    }
}
