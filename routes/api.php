<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;

Route::get('prueba', function () {
    return response()->json(["Hola"]);
});
Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('user', [AuthenticationController::class, 'userInfo']);
    Route::get('logout', [AuthenticationController::class, 'logOut']);

});