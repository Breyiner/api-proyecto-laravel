<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\API\City\CityController;
use App\Http\Controllers\API\Gender\GenderController;
use App\Http\Controllers\API\Profile\ProfileController;
use App\Http\Controllers\API\Status\StatusController;
use App\Http\Controllers\API\TransactionCategory\TransactionCategoryController;
use App\Http\Controllers\API\TransactionType\TransactionTypeController;
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


    //Routes genders
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


    //Routes profiles
    Route::get('/profiles', [ProfileController::class, 'index'])
        ->middleware('permission:profiles.index');

    Route::get('/profiles/me', [ProfileController::class, 'showOwn'])
        ->middleware('permission:profiles.show-own');

    Route::get('/profiles/{profile_id}', [ProfileController::class, 'show'])
        ->middleware('permission:profiles.show');

    Route::get('/profiles/user/{user_id}', [ProfileController::class, 'showByUser'])
        ->middleware('permission:profiles.show-user');

    Route::put('/profiles/me', [ProfileController::class, 'updateOwn'])
        ->middleware('permission:profiles.update-own');

    Route::put('/profiles/user/{user_id}', [ProfileController::class, 'update'])
        ->middleware('permission:profiles.update');
        
    Route::patch('/profiles/me', [ProfileController::class, 'partialUpdateOwn'])
        ->middleware('permission:profiles.update-own');

    Route::patch('/profiles/user/{user_id}', [ProfileController::class, 'partialUpdate'])
        ->middleware('permission:profiles.update');


    //Routes tipos de movimientos
    Route::get('/transactionTypes', [TransactionTypeController::class, 'index'])
        ->middleware('permission:transaction-types.index');

    Route::get('/transactionTypes/{type_id}', [TransactionTypeController::class, 'show'])
        ->middleware('permission:transaction-types.show');

    Route::post('/transactionTypes', [TransactionTypeController::class, 'store'])
        ->middleware('permission:transaction-types.store');

    Route::put('/transactionTypes/{type_id}', [TransactionTypeController::class, 'update'])
        ->middleware('permission:transaction-types.update');

    Route::patch('/transactionTypes/{type_id}', [TransactionTypeController::class, 'partialUpdate'])
        ->middleware('permission:transaction-types.update');

    Route::delete('/transactionTypes/{type_id}', [TransactionTypeController::class, 'destroy'])
        ->middleware('permission:transaction-types.destroy');


    //Routes categorias
    Route::get('/transactionCategories', [TransactionCategoryController::class, 'index'])
        ->middleware('permission:transaction-types.index');

    Route::get('/transactionCategories/{category_id}', [TransactionCategoryController::class, 'show'])
        ->middleware('permission:transaction-types.show');

    Route::post('/transactionCategories', [TransactionCategoryController::class, 'store'])
        ->middleware('permission:transaction-types.store');

    Route::put('/transactionCategories/{category_id}', [TransactionCategoryController::class, 'update'])
        ->middleware('permission:transaction-types.update');

    Route::patch('/transactionCategories/{category_id}', [TransactionCategoryController::class, 'partialUpdate'])
        ->middleware('permission:transaction-types.update');

    Route::delete('/transactionCategories/{category_id}', [TransactionCategoryController::class, 'destroy'])
        ->middleware('permission:transaction-types.destroy');
});