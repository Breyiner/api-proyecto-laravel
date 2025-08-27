<?php

namespace App\Services\Gender;

use App\Models\Gender;
use Illuminate\Support\Arr;

class GenderService {

    public static function getAll() {

        $genders = Gender::all();

        if (count($genders) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay géneros registrados",
                "data" => $genders
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Géneros obtenidos con éxito",
            "data" => $genders
        ];

    }

    public function getGender($id) {

        $gender = Gender::find($id);

        if (!$gender) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este género no existe",
            ];

        return [
            "error" => false,
            "code" => 200,
            "message" => "Género obtenido con éxito",
            "data" => $gender
        ];

    }

    public function createGender(array $data) {

        $gender = Gender::create([
            'name' => $data['name'],
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Género creado con éxito',
        ];

    }

    public function updateGender(array $data, $id) {

        $gender = Gender::find($id);

        if (!$gender) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este género no existe",
            ];

        $gender->update(Arr::only($data, ['name']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Género actualizado con éxito",
        ];

    }

    public function partialUpdateGender(array $entryData, $id) {

        $gender = Gender::find($id);

        if (!$gender) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este género no existe",
            ];

        $gender->update($entryData);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Género actualizado con éxito",
        ];
    }

    public function deleteGender($id) {

        $gender = Gender::find($id);
        
        if (!$gender) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este género no existe",
            ];

        $gender->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Género eliminado con éxito",
        ];
    }

}