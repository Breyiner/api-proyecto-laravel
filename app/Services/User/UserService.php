<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function getAllUsers() {

        $users = User::all();

        return $users;
    }

    public function getUser($id) {

        $user = User::findOrFail($id);

        return $user;

    }

    public function createUser(array $data) {

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('Usuario');

        Profile::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'last_name' => $data['last_name'],
        ]);

        return $user;

    }

    public function updateUser(array $data, $id) {

        $user = User::findOrFail($id);

        $user->update(Arr::only($data, ['email', 'password', 'status_id']));

        return $user;
    }

    public function partialUpdatepdateUser(array $data, $id) {

        $user = User::findOrFail($id);

        $user->update(Arr::only($data, []));

        return $user;
    }

    public function updateEmail(array $data, $id) {

        $user = User::findOrFail($id);

    }

    public function updatePassword(array $data, $id) {

        $user = User::findOrFail($id);

    }

    public function updateRole(array $data, $id) {

        $user = User::findOrFail($id);

    }

    public function updateStatus(array $data, $id) {

        $user = User::findOrFail($id);

    }

    public function deleteUser($id) {

        $user = User::findOrFail($id);
        
        $user->delete();

    }
}