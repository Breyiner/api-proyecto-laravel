<?php

namespace App\Http\Requests\Color;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateColorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $colorId = $this->route('color_id');

        return [
            'name' => 'sometimes|string|min:3|max:50|unique:colors,name,' . $colorId,
            'hex' => 'sometimes|string|size:7|unique:colors,hex,' . $colorId,
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El :attribute debe ser texto.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'name.max' => 'El :attribute no debe superar :max caracteres.',
            'name.unique' => 'El :attribute ya existe.',

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
