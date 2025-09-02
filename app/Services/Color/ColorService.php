<?php

namespace App\Services\Color;

use App\Models\Color;
use Arr;

class ColorService
{
    /**
     * Obtener todos los colores
     */
    public static function getAll()
    {
        $colors = Color::all();

        if ($colors->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay colores registrados",
                "data" => $colors
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Colores obtenidos con éxito",
            "data" => $colors
        ];
    }

    /**
     * Obtener un color por id
     */
    public function getColor($id)
    {
        $color = Color::find($id);

        if (!$color) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este color no existe",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Color obtenido con éxito",
            "data" => $color
        ];
    }

    /**
     * Crear un nuevo color
     */
    public function createColor(array $data)
    {
        $color = Color::create([
            'name' => strtolower($data['name']), // forzar minúscula para consistencia
            'hex' => $data['hex'],
        ]);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Color creado con éxito",
            "data" => $color
        ];
    }

    /**
     * Actualizar un color existente
     */
    public function updateColor(array $data, $id)
    {
        $color = Color::find($id);

        if (!$color) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este color no existe",
            ];
        }

        $color->update(Arr::only($data, ['name', 'hex']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Color actualizado con éxito",
            "data" => $color
        ];
    }

    /**
     * Actualización parcial (PATCH)
     */
    public function partialUpdateColor(array $data, $id)
    {
        $color = Color::find($id);

        if (!$color) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este color no existe",
            ];
        }

        $color->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Color actualizado con éxito",
            "data" => $color
        ];
    }

    /**
     * Eliminar un color
     */
    public function deleteColor($id)
    {
        $color = Color::find($id);

        if (!$color) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este color no existe",
            ];
        }

        if ($color->goalTransacTypes()->exists() || $color->TransacTypes()->exists()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el color porque tiene elementos relacionados",
            ];
        }

        $color->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Color eliminado con éxito",
        ];
    }
}
