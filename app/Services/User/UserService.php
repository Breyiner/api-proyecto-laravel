<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function getAllUsers() {

        $users = User::all();

        return $users;
    }

    public function createUser(array $data) {

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('Usuario');

        return $user;

    }

    public function updateUser(array $data, $id) {

        $user = User::findOrFail($id);

        $user->update(Arr::only($data, ['name', 'email']));

        return $user;
    }

    public function deleteUser($id) {

        $user = User::findOrFail($id);
        
        $user->delete();

    }
}