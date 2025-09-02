<?php

namespace App\Services\TransactionCategory;

use App\Models\TransactionCategory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function getByType($type_id) {

        $transCategories = TransactionCategory::where('transaction_type_id', $type_id)->get();

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

    public function getSummaryTypePeriod($user_id, $data) {

        $month = $data['month'];
        $year = $data['year'];
        $type_id = $data['type_id'];

        $categories = DB::select(
                        "SELECT 
                            c.id, 
                            c.name,
                            COUNT(t.id) AS total_transactions,
                            CAST(COALESCE(SUM(t.amount),0) AS SIGNED) AS sum_transactions,
                            col.hex AS color,
                            i.icon AS icon,
                            DATE_FORMAT(c.created_at, '%Y-%m-%d') AS created_at,
                            DATE_FORMAT(c.updated_at, '%Y-%m-%d') AS updated_at
                        FROM transaction_categories c
                        INNER JOIN transactions t 
                            ON t.transaction_category_id = c.id
                        INNER JOIN transaction_types tt 
                            ON c.transaction_type_id = tt.id
                            AND tt.id = ?
                        INNER JOIN colors col 
                            ON tt.color_id = col.id
                        LEFT JOIN icons i
                            ON c.icon_id = i.id
                        WHERE t.user_id = ?
                            AND MONTH(t.created_at) = ?
                            AND YEAR(t.created_at) = ?
                        GROUP BY c.id, c.name, col.hex, i.icon, c.created_at, c.updated_at
                        ORDER BY sum_transactions DESC",
                        [$type_id, $user_id, $month, $year]
                    );


        if (count($categories) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay categorías registradas",
                "data" => $categories
            ];

        $categories = collect($categories)->map(function($category) {
            $category->total_transactions = (int) $category->total_transactions;
            $category->sum_transactions = (float) $category->sum_transactions;
            return $category;
        });


        return [
            "error" => false,
            "code" => 200,
            "message" => "Categorías obtenidas con éxito",
            "data" => $categories
        ];

    }

    public function createTransactionCategory(array $data) {

        $transCategory = TransactionCategory::create([
            'name' => $data['name'],
            'transaction_type_id' => $data['transaction_type_id'],
            'icon_id' => $data['icon_id']
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

        $transCategory->update(Arr::only($data, ['name', 'transaction_type_id', 'icon_id']));

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

        if ($transCategory->transactions()->exists()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar la categoría porque tiene movimientos relacionados",
            ];
        }

        $transCategory->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Categoría eliminada con éxito",
        ];
    }
}
