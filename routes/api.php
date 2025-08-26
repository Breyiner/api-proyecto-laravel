<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\API\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthenticationController;

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/refresh-token', [AuthenticationController::class, 'refreshToken'])
        ->middleware('ability:'.TokenAbility::ISSUE_ACCESS_TOKEN->value);

    Route::post('/logout', [AuthenticationController::class, 'logOut']);


    //Routes User
    Route::get('/users', [UserController::class, 'index'])
        ->middleware('permission:users.index');

    Route::get('/users/me', [UserController::class, 'showOwn'])
        ->middleware('permission:users.show-own');

    Route::get('/users/{user_id}', [UserController::class, 'show'])
        ->middleware('permission:users.show');

    Route::post('/users', [UserController::class, 'store'])
        ->middleware('permission:users.store');

    Route::put('/users/{user_id}', [UserController::class, 'update'])
        ->middleware('permission:users.update');

    Route::patch('/users/{user_id}', [UserController::class, 'partialUpdate'])
        ->middleware('permission:users.update');

    Route::patch('/users/{user_id}/role', [UserController::class, 'updateRole'])
        ->middleware('permission:users.update-role');

    Route::patch('/users/me/email', [UserController::class, 'updateOwnEmail'])
        ->middleware('permission:users.update-own-email');

    Route::patch('/users/me/password', [UserController::class, 'updateOwnPassword'])
        ->middleware('permission:users.update-own-password');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->middleware('permission:users.destroy');

});