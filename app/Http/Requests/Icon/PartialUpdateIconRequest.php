<?php

namespace App\Http\Requests\Icon;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateIconRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|min:3|max:50',
            'icon' => 'sometimes|required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'name.min' => 'El nombre debe tener al menos :min caracteres.',
            'name.max' => 'El nombre no debe exceder :max caracteres.',
            'icon.required' => 'El icono es obligatorio.',
            'icon.string' => 'El icono debe ser texto.',
            'icon.max' => 'El icono no debe exceder :max caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'icon' => 'icono',
        ];
    }
}
