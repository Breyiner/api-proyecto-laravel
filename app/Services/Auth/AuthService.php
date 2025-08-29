<?php

namespace App\Services\Auth;

use App\Enums\TokenAbility;
use App\Models\Profile;
use App\Models\User;
use App\Services\Profile\ProfileService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    
    public function register(array $data)
    {
        $user = User::create([
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


        $dataProfile = [
            'user_id' => $user->id,
            'name' => $data['name'],
            'last_name' => $data['last_name'],
        ];
        ProfileService::createProfile($dataProfile);

        return $user;
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }

        $user = Auth::user();

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
            'cookieToken' => $cookieToken,
            'cookieRefreshToken' => $cookieRefreshToken,
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

        return [
            'access_token'  => $accessToken,
            'refresh_token' => $refreshToken,
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

    public function logOut(User $user)
    {
        $user->tokens()->delete();
    }
}
