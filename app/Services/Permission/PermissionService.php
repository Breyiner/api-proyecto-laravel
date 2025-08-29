<?php

namespace App\Services\Permission;

use App\Models\Permission;
use Illuminate\Support\Arr;

class PermissionService
{
    public static function getAll() 
    {
        $permissions = Permission::all();

        if (count($permissions) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay permisos registrados",
                "data" => $permissions
            ];

        return [
            "error" => false,
            "code" => 200,
            "message" => "Permisos obtenidos con éxito",
            "data" => $permissions
        ];
    }

    public function getPermission($id) 
    {
        $permission = Permission::find($id);

        if (!$permission) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este permiso no existe",
            ];

        return [
            "error" => false,
            "code" => 200,
            "message" => "Permiso obtenido con éxito",
            "data" => $permission
        ];
    }

    public function createPermission(array $data) 
    {
        $permission = Permission::create([
            'name' => $data['name'],
            'descripcion' => $data['descripcion'] ?? null,
            'guard_name' => $data['guard_name'] ?? 'web',
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Permiso creado con éxito',
        ];
    }

    public function updatePermission(array $data, $id) 
    {
        $permission = Permission::find($id);

        if (!$permission) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este permiso no existe",
            ];

        $permission->update(Arr::only($data, ['name', 'descripcion', 'guard_name']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Permiso actualizado con éxito",
        ];
    }

    public function partialUpdatePermission(array $entryData, $id) 
    {
        $permission = Permission::find($id);

        if (!$permission) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este permiso no existe",
            ];

        $permission->update($entryData);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Permiso actualizado con éxito",
        ];
    }

    public function deletePermission($id) 
    {
        $permission = Permission::find($id);
        
        if (!$permission) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este permiso no existe",
            ];

        $permission->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Permiso eliminado con éxito",
        ];
    }
}
