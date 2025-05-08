<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TarjetsController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsUserAuth;
use App\Http\Middleware\Isadmin;


//Route::get('/user', function (Request $request) {
  //  return $request->user();
//})->middleware('auth:sanctum');

Route::get('/tarjets', [TarjetsController::class, 'index']);
Route::post('/tarjets', [TarjetsController::class, 'store']);
Route::get('/tarjets/{id}', [TarjetsController::class, 'show']);
Route::put('/tarjets/{id}', [TarjetsController::class, 'update']);
Route::patch('/tarjets/{id}', [TarjetsController::class, 'updatePartial']);
Route::delete('/tarjets/{id}', [TarjetsController::class, 'destroy']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware([IsUserAuth::class])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'getUser']);
    Route::post('tarjets', [TarjetsController::class, 'store']);
});
//ADMIN ROUTES
Route::middleware([Isadmin::class])->group(function () {

    Route::get('users', [AuthController::class, 'getAdmin']);
    Route::get('users/{id}', [AuthController::class, 'getUserById']);
    Route::put('users/{id}', [AuthController::class, 'updateUser']);
    Route::delete('users/{id}', [AuthController::class, 'deleteUser']);



});

