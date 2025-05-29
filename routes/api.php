<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TarjetsController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsUserAuth;
use App\Http\Middleware\Isadmin;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CategoryController;



//Route::get('/user', function (Request $request) {
  //  return $request->user();
//})->middleware('auth:sanctum');

//Rutas publicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('tarjets', [TarjetsController::class, 'index']);
Route::get('tarjets/{id} ', [TarjetsController::class, 'show']);

//Rutas protegidas



// Protected routes (User Auth)
Route::middleware([IsUserAuth::class])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'getUser']);
    //tarjetas privadas

    Route::post('tarjets', [TarjetsController::class, 'store']);

    // Categories management
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::get('/categories/{id}', [CategoryController::class, 'getcategoryById']);
    Route::patch('/categories/{id}', [CategoryController::class, 'patchcategory']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // Games
    Route::get('/games', [GameController::class, 'index']);
    Route::post('/games', [GameController::class, 'store']);
    Route::put('/games/{game}/finish', [GameController::class, 'update']);
    Route::get('/ranking', [GameController::class, 'ranking']);

    Route::get('/games/user/{id}', [GameController::class, 'getGamesByUserId']);
    Route::delete('/games/{game}', [GameController::class, 'destroy']);

});
    // Admin routes
    Route::middleware([Isadmin::class])->group(function () {
        // User management
        Route::get('users', [AuthController::class, 'getAdmin']);
        Route::get('users/{id}', [AuthController::class, 'getUserById']);
        Route::put('users/{id}', [AuthController::class, 'updateUser']);
        Route::delete('users/{id}', [AuthController::class, 'deleteUser']);


        // partidas
        Route::get('/games', [GameController::class, 'getgamesadmin']);

        Route::get('/users/{id}/games', [GameController::class, 'getGamesByUserId']);

        // Full CRUD for tarjets

        Route::put('/tarjets/{id}', [TarjetsController::class, 'update']);
        Route::patch('/tarjets/{id}', [TarjetsController::class, 'updatePartial']);
        Route::delete('/tarjets/{id}', [TarjetsController::class, 'destroy']);


    });

