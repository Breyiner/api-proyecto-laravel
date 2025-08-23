<?php

use App\Enums\TokenAbility;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthenticationController;

Route::get('prueba', function () {
    return response()->json(["Hola"]);
});
Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('refresh-token', [AuthenticationController::class, 'refreshToken'])->middleware('ability:'.TokenAbility::ISSUE_ACCESS_TOKEN->value);

    Route::post('logout', [AuthenticationController::class, 'logOut']);

});