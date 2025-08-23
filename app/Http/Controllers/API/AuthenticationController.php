<?php

namespace App\Http\Controllers\API;

use App\Enums\TokenAbility;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return response()->json(['message' => 'Usuario registrado con éxito']);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt(Arr::only($data, ['email', 'password']))) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $accessToken = Auth::user()->createToken(
            'accessToken', 
            [TokenAbility::ACCESS_API->value], 
            Carbon::now()->addMinutes(config('sanctum.access_token_expiration'))
        )->plainTextToken;

        $refreshToken = Auth::user()->createToken(
            'refreshToken', 
            [TokenAbility::ISSUE_ACCESS_TOKEN->value], 
            Carbon::now()->addMinutes(config('sanctum.refresh_token_expiration'))
        )->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Inicio de sesión exitoso',
            'data' => [
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken
            ]
        ]);
    }

    public function refreshToken (Request $request) 
    {
        $user = Auth::user();

        $user->currentAccessToken()>delete();

        $accessToken = $user->createToken(
            'accessToken', 
            [TokenAbility::ACCESS_API->value], 
            Carbon::now()->addMinutes(config('sanctum.access_token_expiration'))
        )->plainTextToken;

        $refreshToken = $user->createToken(
            'refreshToken', 
            [TokenAbility::ISSUE_ACCESS_TOKEN->value], 
            Carbon::now()->addMinutes(config('sanctum.refresh_token_expiration'))
        )->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Token refrescado exitosamente',
            'data' => [
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken
            ]
        ]);
    }

    public function userInfo(Request $request)
    {
        return response()->json($request->user());
    }

    public function logOut(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada con éxito']);
    }
}