<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = $this->authService->register($data);

        return response()->json(['message' => 'Usuario registrado con éxito']);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $result = $this->authService->login($credentials);

        if(!$result)
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);

        return response()->json([
            'success' => true,
            'message' => 'Inicio de sesión exitoso',
            'data' => $result
        ]);
    }

    public function refreshToken (Request $request) 
    {
        $user = Auth::user();

        $currentRefreshToken = $request->bearerToken();

        $data = $this->authService->refreshToken($currentRefreshToken, $user);

        return response()->json([
            'success' => true,
            'message' => 'Token refrescado exitosamente',
            'data' => $data
        ]);
    }

    public function logOut(Request $request)
    {
        $user = Auth::user();

        $this->authService->logOut($user);
        return response()->json(['message' => 'Sesión cerrada con éxito']);
    }
}