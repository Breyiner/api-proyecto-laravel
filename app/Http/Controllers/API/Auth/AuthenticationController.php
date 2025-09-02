<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\ResponseFormatter;
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

        $response = $this->authService->register($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $result = $this->authService->login($credentials);

        if(!$result)
            return response()->json([
                'success' => false,
                'message' => 'Credenciales incorrectas'
            ], 401);

        return response()->json([
            'success' => true,
            'message' => 'Inicio de sesión exitoso',
            'data' => [
                'id' => $result['id'],
                'full_name' => $result['full_name'],
                'role_id'=> $result['role_id'],
                'permissions' => $result['permissions'],
                'token' => $result['token'],
            ]
        ])->cookie($result['cookieToken'])
          ->cookie($result['cookieRefreshToken']);
    }

    public function refreshToken (Request $request) 
    {
        $user = Auth::user();

        $currentRefreshToken = $request->bearerToken();

        $result = $this->authService->refreshToken($currentRefreshToken, $user);

        return response()->json([
            'success' => true,
            'message' => 'Token refrescado exitosamente',
            'data' => []
        ])->cookie($result['cookieToken'])
          ->cookie($result['cookieRefreshToken']);
    }

    public function logOut(Request $request)
    {
        $user = Auth::user();

        $this->authService->logOut($user);
        
        $expiredCookies = $this->authService->createExpiredCookies();
        
        return response()->json(['success' => true, 'message' => 'Sesión cerrada con éxito'])
            ->cookie($expiredCookies['expiredAccessToken'])
            ->cookie($expiredCookies['expiredRefreshToken']);
    }
}