<?php

use App\Enums\TokenAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;

Route::get('prueba', function () {
    return response()->json(["Hola"]);
});
Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('refresh-token', [AuthenticationController::class, 'refreshToken'])->middleware('ability:'.TokenAbility::ISSUE_ACCESS_TOKEN->value);

    Route::get('user', [AuthenticationController::class, 'userInfo']);
    Route::get('logout', [AuthenticationController::class, 'logOut']);

});