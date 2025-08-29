<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|min:3|max:50|unique:roles,name,' . $this->route('role_id'),
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El :attribute debe ser en formato de texto.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'name.max' => 'El :attribute no debe tener más de :max caracteres.',
            'name.unique' => 'El :attribute ya existe.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
        ];
    }
}
