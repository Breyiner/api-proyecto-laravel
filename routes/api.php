<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\API\City\CityController;
use App\Http\Controllers\API\Gender\GenderController;
use App\Http\Controllers\API\Status\StatusController;
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

    
    //Routes status
    Route::get('/statuses', [StatusController::class, 'index'])
        ->middleware('permission:statuses.index');

    Route::get('/statuses/{status_id}', [StatusController::class, 'show'])
        ->middleware('permission:statuses.show');

    Route::post('/statuses', [StatusController::class, 'store'])
        ->middleware('permission:statuses.store');

    Route::put('/statuses/{status_id}', [StatusController::class, 'update'])
        ->middleware('permission:statuses.update');
        
    Route::patch('/statuses/{status_id}', [StatusController::class, 'partialUpdate'])
        ->middleware('permission:statuses.update');

    Route::delete('/statuses/{status_id}', [StatusController::class, 'destroy'])
        ->middleware('permission:statuses.destroy');

        
    //Routes city
    Route::get('/cities', [CityController::class, 'index'])
        ->middleware('permission:cities.index');

    Route::get('/cities/{city_id}', [CityController::class, 'show'])
        ->middleware('permission:cities.show');

    Route::post('/cities', [CityController::class, 'store'])
        ->middleware('permission:cities.store');

    Route::put('/cities/{city_id}', [CityController::class, 'update'])
        ->middleware('permission:cities.update');
        
    Route::patch('/cities/{city_id}', [CityController::class, 'partialUpdate'])
        ->middleware('permission:cities.update');

    Route::delete('/cities/{city_id}', [CityController::class, 'destroy'])
        ->middleware('permission:cities.destroy');


    //Routes city
    Route::get('/genders', [GenderController::class, 'index'])
        ->middleware('permission:genders.index');

    Route::get('/genders/{gender_id}', [GenderController::class, 'show'])
        ->middleware('permission:genders.show');

    Route::post('/genders', [GenderController::class, 'store'])
        ->middleware('permission:genders.store');

    Route::put('/genders/{gender_id}', [GenderController::class, 'update'])
        ->middleware('permission:genders.update');
        
    Route::patch('/genders/{gender_id}', [GenderController::class, 'partialUpdate'])
        ->middleware('permission:genders.update');

    Route::delete('/genders/{gender_id}', [GenderController::class, 'destroy'])
        ->middleware('permission:genders.destroy');
});