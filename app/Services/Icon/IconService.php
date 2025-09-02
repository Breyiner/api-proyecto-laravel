<?php

namespace App\Services\Icon;

use App\Models\Icon;
use Arr;

class IconService
{
    public static function getAll()
    {
        $icons = Icon::all();
        return [
            'error' => false,
            'code' => 200,
            'message' => $icons->isEmpty() ? 'No hay íconos registrados' : 'Íconos obtenidos con éxito',
            'data' => $icons
        ];
    }

    public function getIcon($id)
    {
        $icon = Icon::find($id);
        if (!$icon) return ['error' => true, 'code' => 404, 'message' => 'Este ícono no existe'];
        return ['error' => false, 'code' => 200, 'message' => 'Ícono obtenido con éxito', 'data' => $icon];
    }

    public function createIcon(array $data)
    {
        $icon = Icon::create([
            'name' => $data['name'],
            'icon' => $data['icon']
        ]);

        return ['error' => false, 'code' => 201, 'message' => 'Ícono creado con éxito', 'data' => $icon];
    }

    public function updateIcon(array $data, $id)
    {
        $icon = Icon::find($id);
        if (!$icon) return ['error' => true, 'code' => 404, 'message' => 'Este ícono no existe'];

        $icon->update(Arr::only($data, ['name', 'icon']));

        return ['error' => false, 'code' => 200, 'message' => 'Ícono actualizado con éxito', 'data' => $icon];
    }

    public function partialUpdateIcon(array $data, $id)
    {
        $icon = Icon::find($id);
        if (!$icon) return ['error' => true, 'code' => 404, 'message' => 'Este ícono no existe'];

        $icon->update($data);

        return ['error' => false, 'code' => 200, 'message' => 'Ícono actualizado con éxito', 'data' => $icon];
    }

    public function deleteIcon($id)
    {
        $icon = Icon::find($id);
        if (!$icon) return ['error' => true, 'code' => 404, 'message' => 'Este ícono no existe'];

        $icon->delete();
        return ['error' => false, 'code' => 200, 'message' => 'Ícono eliminado con éxito'];
    }
}
