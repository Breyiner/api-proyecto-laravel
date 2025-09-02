<?php

namespace App\Services\GoalStatus;

use App\Models\GoalStatus;
use Arr;

class GoalStatusService
{
    public static function getAll() {

        $statuses = GoalStatus::all();

        if (count($statuses) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay estados registrados",
                "data" => $statuses
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Estados obtenidos con éxito",
            "data" => $statuses
        ];

    }

    public function getStatus($id) {

        $status = GoalStatus::find($id);

        if (!$status) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este estado no existe",
            ];

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado obtenido con éxito",
            "data" => $status
        ];

    }

    public function createStatus(array $data) {

        $status = GoalStatus::create([
            'name' => $data['name'],
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Estado creado con éxito',
        ];

    }

    public function updateStatus(array $data, $id) {

        $status = GoalStatus::find($id);

        if (!$status) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este estado no existe",
            ];

        $status->update(Arr::only($data, ['name']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado actualizado con éxito",
        ];

    }

    public function partialUpdateStatus(array $entryData, $id) {

        $status = GoalStatus::find($id);

        if (!$status) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este estado no existe",
            ];

        $status->update($entryData);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado actualizado con éxito",
        ];
    }

    public function deleteStatus($id) {

        $status = GoalStatus::find($id);
        
        if (!$status) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este estado no existe",
            ];

        if ($status->goals()->exists()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el estado porque tiene metas relacionadas",
            ];
        }

        $status->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado eliminado con éxito",
        ];
    }
}
