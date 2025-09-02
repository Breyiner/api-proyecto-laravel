<?php

namespace App\Services\Auth;

use App\Enums\TokenAbility;
use App\Models\Profile;
use App\Models\User;
use App\Services\Profile\ProfileService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    
    public function register(array $data)
    {
        try {
            DB::beginTransaction();

            // Crear usuario
            $user = User::create([
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            if (!$user) {
                DB::rollBack();
                return [
                    "error" => true,
                    "code" => 400,
                    "message" => "Error al crear el usuario",
                ];
            }

            $user->assignRole('Usuario');

            // Crear perfil
            $dataProfile = [
                'user_id'  => $user->id,
                'first_name'     => $data['first_name'],
                'last_name'=> $data['last_name'],
                'gender_id'=> $data['gender_id'],
                'city_id'  => $data['city_id'],
            ];

            $profile = ProfileService::createProfile($dataProfile);

            if (!$profile) {
                DB::rollBack();
                return [
                    "error" => true,
                    "code" => 400,
                    "message" => "Error al crear el perfil",
                ];
            }

            DB::commit();

            return [
                "error" => false,
                "code" => 201,
                "message" => "Usuario registrado correctamente",
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            return [
                "error" => true,
                "code" => 500,
                "message" => "Ocurrió un error en el registro: " . $e->getMessage(),
            ];
        }
    }

    public function login(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        if ($user->status_id != 1) {
            return [
                "error" => true,
                "code" => 403,
                "message" => "El usuario está inactivo",
            ];
        }

        if (!Auth::attempt($credentials)) {
            return null;
        }

        $profile = $user->profile;

        $roleUser = $user->roles->first();

        $permissions = $roleUser->permissions;

        $accessToken = $this->generateAccessToken($user);

        $refreshToken = $this->generateRefreshToken($user);

        $cookieToken = cookie(
            'access_token',
            $accessToken,
            60 * 24 * 365 * 100,
            '/',
            null,
            false,
            false,
            false,
            'lax'
        );

        $cookieRefreshToken = cookie(
            'refresh_token',
            $refreshToken,
            60 * 24 * 365 * 100,
            '/',
            null,
            false,
            false,
            false,
            'lax'
        );

        return [
            'id' => $user->id,
            'full_name' => "$profile->first_name $profile->last_name",
            'role_id' => $roleUser->id,
            'permissions' => $permissions->pluck('name'),
            'cookieToken' => $cookieToken,
            'cookieRefreshToken' => $cookieRefreshToken,
            'token' => $accessToken,
        ];
    }

    private function generateAccessToken($user) {

        return $user->createToken(
            'accessToken',
            [TokenAbility::ACCESS_API->value],
            Carbon::now()->addMinutes(config('sanctum.access_token_expiration'))
        )->plainTextToken;

    }

    private function generateRefreshToken($user) {

        return $user->createToken(
            'refreshToken',
            [TokenAbility::ISSUE_ACCESS_TOKEN->value],
            Carbon::now()->addMinutes(config('sanctum.refresh_token_expiration'))
        )->plainTextToken;

    }

    public function refreshToken(string $currentRefreshToken, User $user) {

        $refreshToken = PersonalAccessToken::findToken($currentRefreshToken);

        $accessToken = $this->generateAccessToken($user);

        $refreshToken = $this->renewRefreshToken($refreshToken, $user)?:$currentRefreshToken;

        $cookieToken = cookie(
            'access_token',
            $accessToken,
            60 * 24 * 365 * 100,
            '/',
            null,
            false,
            false,
            false,
            'lax'
        );

        $cookieRefreshToken = cookie(
            'refresh_token',
            $refreshToken,
            60 * 24 * 365 * 100,
            '/',
            null,
            false,
            false,
            false,
            'lax'
        );

        return [
            'cookieToken' => $cookieToken,
            'cookieRefreshToken' => $cookieRefreshToken,
        ];
    }

    private function renewRefreshToken(PersonalAccessToken $refreshToken, User $user) {

        $expiresToken = Carbon::parse($refreshToken->expires_at);

        $remainingTime = $expiresToken->diffInSeconds(Carbon::now(), false);

        if($remainingTime < 60 * 60 * 24) {

            $refreshToken->delete();

            return $user->createToken(
                'refreshToken', 
                [TokenAbility::ISSUE_ACCESS_TOKEN->value], 
                Carbon::now()->addMinutes(config('sanctum.refresh_token_expiration'))
            )->plainTextToken;

        }

        return null;

    }

    public function createExpiredCookies()
    {
        $expiredAccessToken = cookie(
            'access_token',
            '',
            -1,
            '/',
            null,
            false,
            false,
            false,
            'lax'
        );

        $expiredRefreshToken = cookie(
            'refresh_token',
            '',
            -1,
            '/',
            null,
            false,
            false,
            false,
            'lax'
        );

        return [
            'expiredAccessToken' => $expiredAccessToken,
            'expiredRefreshToken' => $expiredRefreshToken,
        ];
    }

    public function logOut(User $user)
    {
        $user->tokens()->delete();
}
}
