<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCategoryPeriodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|numeric|exists:transaction_categories,id',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|digits:4|min:2000|max:' . date('Y'),
        ];
    }

    public function messages(): array
    {
        return [
            // required
            'category_id.required' => 'La :attribute es obligatoria',
            'month.required' => 'El :attribute es obligatorio',
            'year.required' => 'El :attribute es obligatorio',

            // numeric
            'category_id.numeric' => 'La :attribute debe ser numérica',
            'month.numeric' => 'El :attribute debe ser numérico',
            'year.numeric' => 'El :attribute debe ser numérico',

            // exists
            'category_id.exists' => 'La :attribute seleccionada no existe',

            // rango
            'month.min' => 'El :attribute debe ser al menos :min',
            'month.max' => 'El :attribute no puede ser mayor a :max',
            'year.digits' => 'El :attribute debe tener exactamente :digits dígitos',
            'year.min' => 'El :attribute debe ser mayor o igual a :min',
            'year.max' => 'El :attribute no puede ser mayor al año actual',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'categoría',
            'month' => 'mes',
            'year' => 'año',
        ];
    }

    protected function prepareForValidation()
{
    $this->merge([
        'category_id' => $this->route('category_id'),
    ]);
}
}
