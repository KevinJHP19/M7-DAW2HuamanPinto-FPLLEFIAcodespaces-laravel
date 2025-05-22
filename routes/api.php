<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetsController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAunthenticated;
use App\Http\Middleware\Isadmin;


//Route::get('/user', function (Request $request) {
  //  return $request->user();
//})->middleware('auth:sanctum');

Route::get('/pets', [PetsController::class, 'index']);
Route::post('/pets', [PetsController::class, 'store']);
Route::get('/pets/{id}', [PetsController::class, 'show']);
Route::put('/pets/{id}', [PetsController::class, 'update']);
Route::patch('/pets/{id}', [PetsController::class, 'updatePartial']);
Route::delete('/pets/{id}', [PetsController::class, 'destroy']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware([IsAunthenticated::class])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'getUser']);
    Route::post('pets', [petsController::class, 'store']);
});
//ADMIN ROUTES
Route::middleware([Isadmin::class])->group(function () {

    Route::get('users', [AuthController::class, 'getAdmin']);
    Route::get('users/{id}', [AuthController::class, 'getUserById']);
    Route::put('users/{id}', [AuthController::class, 'updateUser']);
    Route::delete('users/{id}', [AuthController::class, 'deleteUser']);



});

