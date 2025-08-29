<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\API\Balance\BalanceController;
use App\Http\Controllers\API\City\CityController;
use App\Http\Controllers\API\Color\ColorController;
use App\Http\Controllers\API\Gender\GenderController;
use App\Http\Controllers\API\Goal\GoalController;
use App\Http\Controllers\API\GoalStatus\GoalStatusController;
use App\Http\Controllers\API\GoalTransaction\GoalTransactionController;
use App\Http\Controllers\API\GoalTransactionType\GoalTransactionTypeController;
use App\Http\Controllers\API\Permission\PermissionController;
use App\Http\Controllers\API\Profile\ProfileController;
use App\Http\Controllers\API\Status\StatusController;
use App\Http\Controllers\API\Transaction\TransactionController;
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

    
    //Routes user status
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

        
    //Routes permissions
    Route::get('/permissions', [PermissionController::class, 'index'])
        ->middleware('permission:permissions.index');

    Route::get('/permissions/{permission_id}', [PermissionController::class, 'show'])
        ->middleware('permission:permissions.show');

    Route::post('/permissions', [PermissionController::class, 'store'])
        ->middleware('permission:permissions.store');

    Route::put('/permissions/{permission_id}', [PermissionController::class, 'update'])
        ->middleware('permission:permissions.update');
        
    Route::patch('/permissions/{permission_id}', [PermissionController::class, 'partialUpdate'])
        ->middleware('permission:permissions.update');

    Route::delete('/permissions/{permission_id}', [PermissionController::class, 'destroy'])
        ->middleware('permission:permissions.destroy');

        
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


    //Routes colors
    Route::get('/colors', [ColorController::class, 'index'])
        ->middleware('permission:colors.index');

    Route::get('/colors/{color_id}', [ColorController::class, 'show'])
        ->middleware('permission:colors.show');

    Route::post('/colors', [ColorController::class, 'store'])
        ->middleware('permission:colors.store');

    Route::put('/colors/{color_id}', [ColorController::class, 'update'])
        ->middleware('permission:colors.update');
        
    Route::patch('/colors/{color_id}', [ColorController::class, 'partialUpdate'])
        ->middleware('permission:colors.update');

    Route::delete('/colors/{color_id}', [ColorController::class, 'destroy'])
        ->middleware('permission:colors.destroy');


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
        ->middleware('permission:transaction-categories.index');

    // query params month && year
    Route::get('/transactionCategories/me/period', [TransactionCategoryController::class, 'indexSummaryPeriod'])
        ->middleware('permission:transaction-categories.index-own');  // colores

    Route::get('/transactionCategories/{category_id}', [TransactionCategoryController::class, 'show'])
        ->middleware('permission:transaction-categories.show');

    Route::post('/transactionCategories', [TransactionCategoryController::class, 'store'])
        ->middleware('permission:transaction-categories.store');

    Route::put('/transactionCategories/{category_id}', [TransactionCategoryController::class, 'update'])
        ->middleware('permission:transaction-categories.update');

    Route::patch('/transactionCategories/{category_id}', [TransactionCategoryController::class, 'partialUpdate'])
        ->middleware('permission:transaction-categories.update');

    Route::delete('/transactionCategories/{category_id}', [TransactionCategoryController::class, 'destroy'])
        ->middleware('permission:transaction-categories.destroy');


    //Routes transactions(movimientos)
    Route::get('/transactions', [TransactionController::class, 'index'])
        ->middleware('permission:transactions.index');

    Route::get('/transactions/user/{user_id}', [TransactionController::class, 'indexByUser'])
        ->middleware('permission:transactions.index');

    Route::get('/transactions/category/{category_id}', [TransactionController::class, 'indexByCategory'])
        ->middleware('permission:transactions.index');

    // query params = month & year
    Route::get('/transactions/me/category/{category_id}/period', [TransactionController::class, 'indexByCategoryPeriod'])
        ->middleware('permission:transactions.index-own'); // colores

    // query params = month & year
    Route::get('/transactions/me/period', [TransactionController::class, 'indexByPeriod'])
        ->middleware('permission:transactions.index-own');  // colores

    //query param = date
    Route::get('/transactions/me', [TransactionController::class, 'indexByDate'])
        ->middleware('permission:transactions.index-own');  // colores

    Route::get('/transactions/{transaction_id}', [TransactionController::class, 'show'])
        ->middleware('permission:transactions.show-own');
    
    Route::post('/transactions', [TransactionController::class, 'store'])
        ->middleware('permission:transactions.store');

    Route::put('/transactions/{transaction_id}', [TransactionController::class, 'update'])
        ->middleware('permission:transactions.update');

    Route::patch('/transactions/{transaction_id}', [TransactionController::class, 'partialUpdate'])
        ->middleware('permission:transactions.update');

    Route::delete('/transactions/{transaction_id}', [TransactionController::class, 'destroy'])
        ->middleware('permission:transactions.destroy');


    //Routes metas status
    Route::get('/goalStatuses', [GoalStatusController::class, 'index'])
        ->middleware('permission:goal-statuses.index');

    Route::get('/goalStatuses/{status_id}', [GoalStatusController::class, 'show'])
        ->middleware('permission:goal-statuses.show');

    Route::post('/goalStatuses', [GoalStatusController::class, 'store'])
        ->middleware('permission:goal-statuses.store');

    Route::put('/goalStatuses/{status_id}', [GoalStatusController::class, 'update'])
        ->middleware('permission:goal-statuses.update');
        
    Route::patch('/goalStatuses/{status_id}', [GoalStatusController::class, 'partialUpdate'])
        ->middleware('permission:goal-statuses.update');

    Route::delete('/goalStatuses/{status_id}', [GoalStatusController::class, 'destroy'])
        ->middleware('permission:goal-statuses.destroy');


    //Rutas metas
    Route::get('/goals', [GoalController::class, 'index'])
        ->middleware('permission:goals.index');

    Route::get('/goals/user/{user_id}', [GoalController::class, 'indexGoalsByUser'])
        ->middleware('permission:goals.index');
    
    Route::get('/goals/me', [GoalController::class, 'indexGoalsActiveByUser'])
        ->middleware('permission:goals.index-own');

    // Query params month & year
    Route::get('/goals/me/summary', [GoalController::class, 'indexGoalsSummaryByUser'])
        ->middleware('permission:goals.index-own');
    
    Route::get('/goals/{goal_id}', [GoalController::class, 'show'])
        ->middleware('permission:goals.show-own');
    
    Route::post('/goals', [GoalController::class, 'store'])
        ->middleware('permission:goals.store');

    Route::put('/goals/{goal_id}', [GoalController::class, 'update'])
        ->middleware('permission:goals.update');

    Route::patch('/goals/{goal_id}', [GoalController::class, 'partialUpdate'])
        ->middleware('permission:goals.update');

    Route::delete('/goals/{goal_id}/safe', [GoalController::class, 'destroySafe'])
        ->middleware('permission:goals.destroy-safe');
    
    Route::delete('/goals/{goal_id}', [GoalController::class, 'destroy'])
        ->middleware('permission:goals.destroy');



    //Routes tipos de movimientos
    Route::get('/goalTransactionTypes', [GoalTransactionTypeController::class, 'index'])
        ->middleware('permission:goal-transaction-types.index');

    Route::get('/goalTransactionTypes/{type_id}', [GoalTransactionTypeController::class, 'show'])
        ->middleware('permission:goal-transaction-types.show');

    Route::post('/goalTransactionTypes', [GoalTransactionTypeController::class, 'store'])
        ->middleware('permission:goal-transaction-types.store');

    Route::put('/goalTransactionTypes/{type_id}', [GoalTransactionTypeController::class, 'update'])
        ->middleware('permission:goal-transaction-types.update');

    Route::patch('/goalTransactionTypes/{type_id}', [GoalTransactionTypeController::class, 'partialUpdate'])
        ->middleware('permission:goal-transaction-types.update');

    Route::delete('/goalTransactionTypes/{type_id}', [GoalTransactionTypeController::class, 'destroy'])
        ->middleware('permission:goal-transaction-types.destroy');



    //Routes movimientos de metas
    Route::get('/goalTransactions', [GoalTransactionController::class, 'index'])
        ->middleware('permission:goal-transactions.index');

    // Query params date
    Route::get('/goalTransactions/me', [GoalTransactionController::class, 'indexOwnDate'])
        ->middleware('permission:goal-transactions.index-own'); // colores

    // Query params month & year
    Route::get('/goalTransactions/me/period', [GoalTransactionController::class, 'indexOwnPeriod'])
        ->middleware('permission:goal-transactions.index-own'); // colores

    // Query params month & year
    Route::get('/goalTransactions/goal/{goal_id}/period', [GoalTransactionController::class, 'indexByGoalPeriod'])
        ->middleware('permission:goal-transactions.index-own');  // colores

    Route::get('/goalTransactions/{transaction_id}', [GoalTransactionController::class, 'show'])
        ->middleware('permission:goal-transactions.show-own');

    Route::post('/goalTransactions', [GoalTransactionController::class, 'store'])
        ->middleware('permission:goal-transactions.store');

    Route::put('/goalTransactions/{transaction_id}', [GoalTransactionController::class, 'update'])
        ->middleware('permission:goal-transactions.update');
        
    Route::patch('/goalTransactions/{transaction_id}', [GoalTransactionController::class, 'partialUpdate'])
        ->middleware('permission:goal-transactions.update');

    Route::delete('/goalTransactions/{transaction_id}', [GoalTransactionController::class, 'destroy'])
        ->middleware('permission:goal-transactions.destroy');

    
    //Ruta balance 
    // query params month & year
    Route::get('/balance/me', [BalanceController::class, 'showPeriod'])
        ->middleware('permission:balance.show-own');
});