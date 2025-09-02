<?php

namespace App\Services\GoalTransactionType;

use App\Models\GoalTransactionType;
use Illuminate\Support\Arr;

class GoalTransactionTypeService
{
    public static function getAll() {

        $transTypes = GoalTransactionType::all();

        if (count($transTypes) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay tipos de movimientos de metas registrados",
                "data" => $transTypes
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipos de movimientos de metas obtenidos con éxito",
            "data" => $transTypes
        ];

    }

    public function getGoalTransacType($id) {

        $transType = GoalTransactionType::find($id);

        if (!$transType) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este tipo de movimiento no existe",
            ];

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de movimiento de meta obtenido con éxito",
            "data" => $transType
        ];

    }

    public function createGoalTransacType(array $data) {

        $transType = GoalTransactionType::create([
            'name' => $data['name'],
            'color_id' => $data['color_id'],
            'icon_id' => $data['icon_id'],
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Tipo de movimiento creado con éxito',
        ];

    }

    public function updateGoalTransacType(array $data, $id) {

        $transType = GoalTransactionType::find($id);

        if (!$transType) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este tipo de movimiento de meta no existe",
            ];

        $transType->update(Arr::only($data, ['name', 'color_id', 'icon_id']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de movimiento actualizado con éxito",
        ];

    }

    public function partialUpdateGoalTransacType(array $entryData, $id) {

        $transType = GoalTransactionType::find($id);

        if (!$transType) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este tipo de movimiento de meta no existe",
            ];

        $transType->update($entryData);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de movimiento actualizado con éxito",
        ];
    }

    public function deleteGoalTransacType($id) {

        $transType = GoalTransactionType::find($id);
        
        if (!$transType) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este tipo de movimiento de meta no existe",
            ];

        if ($transType->transactions()->exists()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el tipo porque tiene movimientos relacionados",
            ];
        }

        $transType->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de movimiento eliminado con éxito",
        ];
    }
}
