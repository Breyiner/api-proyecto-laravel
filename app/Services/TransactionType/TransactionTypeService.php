<?php

namespace App\Services\TransactionType;

use App\Models\Color;
use App\Models\TransactionType;
use Illuminate\Support\Arr;

class TransactionTypeService {

    public static function getAll() {

        $transTypes = TransactionType::all();


        // $data = $transTypes->map(function ($type) {
        //     return [
        //         'id'    => $type->id,
        //         'name'  => $type->name,
        //         'color'   => $type->color ? $type->color->hex : null, // hexadecimal del color
        //     ];
        // });

        if (count($transTypes) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay tipos de movimientos registrados",
                "data" => $transTypes
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipos de movimientos obtenidos con éxito",
            "data" => $transTypes
        ];

    }

    public function getWithGoal() {

        $transTypes = TransactionType::with('color')->get();

        if (count($transTypes) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay tipos de movimientos registrados",
                "data" => $transTypes
            ];

        $data = $transTypes->map(function ($type) {
            return [
                'id'    => $type->id,
                'name'  => $type->name,
                'color'   => $type->color ? $type->color->hex : null,
            ];
        });

        
        $metasColor = Color::where('name', 'Metas')->first();

        $data->push([
            'id'    => 0, // id arbitrario
            'name'  => 'Metas',
            'color' => $metasColor ? $metasColor->hex : null,
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipos de movimientos obtenidos con éxito",
            "data" => $data
        ];
    }

    public function getTransactionType($id) {

        $transType = TransactionType::find($id);

        if (!$transType) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este tipos de movimiento no existe",
            ];

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de movimiento obtenido con éxito",
            "data" => $transType
        ];

    }

    public function createTransactionType(array $data) {

        $transType = TransactionType::create([
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

    public function updateTransactionType(array $data, $id) {

        $transType = TransactionType::find($id);

        if (!$transType) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este tipo de movimiento no existe",
            ];

        $transType->update(Arr::only($data, ['name', 'color_id', 'icon_id']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de movimiento actualizado con éxito",
        ];

    }

    public function partialUpdateTransactionType(array $entryData, $id) {

        $transType = TransactionType::find($id);

        if (!$transType) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este tipo de movimiento no existe",
            ];

        $transType->update($entryData);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de movimiento actualizado con éxito",
        ];
    }

    public function deleteTransactionType($id) {

        $transType = TransactionType::find($id);
        
        if (!$transType) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este tipo de movimiento no existe",
            ];

        if ($transType->transactionCategories()->exists()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el tipo porque tiene categorias relacionadas",
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