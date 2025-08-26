<?php

namespace App\Services\City;

use App\Models\City;
use Illuminate\Support\Arr;

class CityService {

    public static function getAll() {

        $cities = City::all();

        if (count($cities) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay ciudades registrados",
                "data" => $cities
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciuades obtenidas con éxito",
            "data" => $cities
        ];

    }

    public function getCity($id) {

        $city = City::find($id);

        if (!$city) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta ciudad no existe",
            ];

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudad obtenida con éxito",
            "data" => $city
        ];

    }

    public function createCity(array $data) {

        $city = City::create([
            'name' => $data['name'],
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Ciudad creada con éxito',
        ];

    }

    public function updateCity(array $data, $id) {

        $city = city::find($id);

        if (!$city) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta ciudad no existe",
            ];

        $city->update(Arr::only($data, ['name']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudad actualizada con éxito",
        ];

    }

    public function partialUpdateCity(array $entryData, $id) {

        $city = City::find($id);

        if (!$city) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta ciudad no existe",
            ];

        
        $data = [];

        foreach ($entryData as $key => $value) {
            $data[$key] = $value;
        }

        $city->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudad actualizada con éxito",
        ];
    }

    public function deleteCity($id) {

        $city = City::find($id);
        
        if (!$city) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta ciudad no existe",
            ];

        $city->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudad eliminada con éxito",
        ];
    }

}