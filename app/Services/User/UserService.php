<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserService
{

    public function getAllUsers() {

        $users = User::all();

        if (count($users) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay usuarios registrados",
                "data" => $users
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuarios obtenidos con éxito",
            "data" => $users
        ];
    }

    public function getCountUsers() {

        $users = User::where('status_id', 1)->get();

        if (count($users) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay usuarios registrados",
                "data" => $users
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuarios obtenidos con éxito",
            "data" => count($users)
        ];

    }

    public function getAllInformation() {
        $users = User::with(['profile.city', 'profile.gender', 'roles', 'status'])->get();

        if ($users->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay usuarios registrados",
                "data" => []
            ];
        }

        $data = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'email' => $user->email,
                'first_name' => optional($user->profile)->first_name,
                'last_name' => optional($user->profile)->last_name,
                'city' => optional(optional($user->profile)->city)->name,
                'gender' => optional(optional($user->profile)->gender)->name,
                'role' => optional($user->roles()->first())->name,
                'status' => optional($user->status)->name,
            ];
        });

        return [
            "error" => false,
            "code" => 200,
            "message" => "Información obtenida con éxito",
            "data" => $data
        ];
}

    public function getUser($id) {

        $user = User::find($id);

        if (!$user) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este usuario no existe",
            ];

        $role = $user->roles()->first();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario obtenido con éxito",
            "data" => [
                'id' => $user->id,
                'email' => $user->email,
                'status_id' => $user->status_id,
                'role_id' => $role ? $role->id : null,
            ]
        ];

    }

    public function createUser(array $data) {

        $user = User::create([
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('Usuario');

        $data['user_id'] = $user->id;

        Profile::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'city_id' => $data['city_id'],
            'gender_id' => $data['gender_id'],
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Usuario creado con éxito',
        ];

    }

    public function updateUser(array $data, $id) {

        $user = User::find($id);

        if (!$user) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este usuario no existe",
            ];

        if (isset($data['role_id'])) {
            $authUser = Auth::user();
            if ($authUser && $authUser->can('users.update-role')) {
                $role = $user->roles()->first();
                if ($role) {
                    $user->removeRole($role->name);
                }
                $newRole = Role::find($data['role_id']);
                if ($newRole) {
                    $user->assignRole($newRole);
                }
            }
            unset($data['role_id']);
        }

        $user->update(Arr::only($data, ['email', 'password', 'status_id']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado con éxito",
        ];

    }

    public function partialUpdateUser(array $entryData, $id) {

        $user = User::find($id);

        if (!$user) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este usuario no existe",
            ];

        if (isset($entryData['role_id'])) {
            $authUser = Auth::user();
            if ($authUser && $authUser->can('users.update-role')) {
                $role = $user->roles()->first();
                if ($role) {
                    $user->removeRole($role->name);
                }
                $newRole = Role::find($entryData['role_id']);
                if ($newRole) {
                    $user->assignRole($newRole);
                }
            }
            unset($entryData['role_id']);
        }

        $user->update($entryData);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado con éxito",
        ];
    }

    public function updateEmail(array $data, $id) {

        $user = User::find($id);

        if (!$user) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este usuario no existe",
            ];

        $user->update([
            "email" => $data['email']
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado con éxito",
        ];

    }

    public function updatePassword(array $data, $id) {
      
        $user = User::find($id);

        if (!$user) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este usuario no existe",
            ];

        if ($data['current_password'])
            if (!Hash::check($data['current_password'], $user->password)) 
                return [
                    "error" => true,
                    "code" => 401,
                    "message" => "Contraseña incorrecta"
                ];


        $user->update([
            "password" => Hash::make($data['password'])
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado con éxito",
        ];
    }

    public function updateRole(array $data, $id) {

        $user = User::find($id);

        if (!$user) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este usuario no existe",
            ];

        $role = $user->roles()->first()->name;

        if (!$user) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este rol no existe",
            ];

        $user->removeRole($role);

        $newRole = Role::find($data['role_id']);

        $user->assignRole($newRole);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado con éxito",
        ];

    }

    public function softDeleteUser($id) {
        $user = User::find($id);

        if (!$user)
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este usuario no existe",
            ];

        $user->update(['status_id' => 2]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario desactivado con éxito",
        ];
    }

    public function deleteUser($id) {

        $user = User::find($id);
        
        if (!$user) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este usuario no existe",
            ];

        $user->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario eliminado con éxito",
        ];
    }
}