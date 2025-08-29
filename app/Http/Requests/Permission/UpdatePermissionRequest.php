<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:50|unique:permissions,name,' . $this->route('permission_id'),
            'descripcion' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.string' => 'El :attribute debe ser en formato de texto.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'name.max' => 'El :attribute no debe tener más de :max caracteres.',
            'name.unique' => 'El :attribute ya existe.',
            'descripcion.required' => 'La :attribute es obligatoria.',
            'descripcion.string' => 'La :attribute debe ser en formato de texto.',
            'descripcion.max' => 'La :attribute no debe tener más de :max caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'descripcion' => 'descripción',
        ];
    }
}
