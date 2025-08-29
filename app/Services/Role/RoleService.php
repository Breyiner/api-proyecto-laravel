<?php

namespace App\Services\Role;

use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class RoleService
{
    public static function getAll()
    {
        $roles = Role::all();

        if (count($roles) == 0) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay roles registrados",
                "data" => $roles,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Roles obtenidos con éxito",
            "data" => $roles,
        ];
    }

    public function getRole($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este rol no existe",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Rol obtenido con éxito",
            "data" => $role,
        ];
    }

    public function createRole(array $data)
    {
        Role::create([
            'name' => $data['name'],
        ]);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Rol creado con éxito",
        ];
    }

    public function updateRole(array $data, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este rol no existe",
            ];
        }

        $role->update(Arr::only($data, ['name']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Rol actualizado con éxito",
        ];
    }

    public function partialUpdateRole(array $data, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este rol no existe",
            ];
        }

        $role->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Rol actualizado con éxito",
        ];
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este rol no existe",
            ];
        }

        $role->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Rol eliminado con éxito",
        ];
    }
}
