<?php

namespace App\Http\Requests\TransactionCategory;

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
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|digits:4|min:2000|max:' . date('Y'),
        ];
    }

    public function messages(): array
    {
        return [
            'month.required' => 'El :attribute es obligatorio',
            'year.required' => 'El :attribute es obligatorio',

            'month.numeric' => 'El :attribute debe ser numérico',
            'year.numeric' => 'El :attribute debe ser numérico',

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
            'month' => 'mes',
            'year' => 'año',
        ];
    }
}
