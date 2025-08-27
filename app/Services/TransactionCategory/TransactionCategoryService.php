<?php

namespace App\Services\TransactionCategory;

use App\Models\TransactionCategory;
use Illuminate\Support\Arr;

class TransactionCategoryService
{
    public static function getAll() {

        $transCategories = TransactionCategory::all();

        if (count($transCategories) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay categorías registradas",
                "data" => $transCategories
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Categorías obtenidas con éxito",
            "data" => $transCategories
        ];

    }

    public function getTransactionCategory($id) {

        $transCategory = TransactionCategory::find($id);

        if (!$transCategory) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta categoría no existe",
            ];

        return [
            "error" => false,
            "code" => 200,
            "message" => "Categoría obtenida con éxito",
            "data" => $transCategory
        ];

    }

    public function createTransactionCategory(array $data) {

        $transCategory = TransactionCategory::create([
            'name' => $data['name'],
            'transaction_type_id' => $data['transaction_type_id'],
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Categoría creada con éxito',
        ];

    }

    public function updateTransactionCategory(array $data, $id) {

        $transCategory = TransactionCategory::find($id);

        if (!$transCategory) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta categoría no existe",
            ];

        $transCategory->update(Arr::only($data, ['name', 'transaction_type_id']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Categoría actualizada con éxito",
        ];

    }

    public function partialUpdateTransactionCategory(array $entryData, $id) {

        $transCategory = TransactionCategory::find($id);

        if (!$transCategory) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta categoría no existe",
            ];

        $transCategory->update($entryData);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Categoría actualizada con éxito",
        ];
    }

    public function deleteTransactionCategory($id) {

        $transCategory = TransactionCategory::find($id);
        
        if (!$transCategory) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta categoría no existe",
            ];

        $transCategory->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Categoría eliminada con éxito",
        ];
    }
}
