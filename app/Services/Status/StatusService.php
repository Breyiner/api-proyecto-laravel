<?php

namespace App\Services\Status;

use App\Models\Status;
use Illuminate\Support\Arr;

class StatusService {

    public static function getAll() {

        $statuses = Status::all();

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

        $status = Status::find($id);

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

        $status = Status::create([
            'name' => $data['name'],
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Estado creado con éxito',
        ];

    }

    public function updateStatus(array $data, $id) {

        $status = Status::find($id);

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

        $status = Status::find($id);

        if (!$status) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este estado no existe",
            ];

        
        $data = [];

        foreach ($entryData as $key => $value) {
            $data[$key] = $value;
        }

        $status->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado actualizado con éxito",
        ];
    }

    public function deleteStatus($id) {

        $status = Status::find($id);
        
        if (!$status) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este estado no existe",
            ];

        $status->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado eliminado con éxito",
        ];
    }

}