<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TransactionDateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            // required
            'date.required' => 'La :attribute es obligatoria',

            // formato
            'date.date_format' => 'La :attribute debe estar en el formato YYYY-MM-DD',

        ];
    }

    public function attributes(): array
    {
        return [
            'date' => 'fecha',
        ];
    }
}
