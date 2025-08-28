<?php

namespace App\Http\Requests\Color;

use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50|unique:colors,name',
            'hex' => 'required|string|size:7|unique:colors,hex',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.string' => 'El :attribute debe ser texto.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'name.max' => 'El :attribute no debe superar :max caracteres.',
            'name.unique' => 'El :attribute ya existe.',

            'hex.required' => 'El :attribute es obligatorio.',
            'hex.string' => 'El :attribute debe ser texto.',
            'hex.size' => 'El :attribute debe tener exactamente :size caracteres.',
            'hex.unique' => 'El :attribute ya existe.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'hex' => 'código hexadecimal',
        ];
    }
}
