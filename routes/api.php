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



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware([IsAunthenticated::class])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'getUser']);
    Route::post('pets', [PetsController::class, 'store']);

    Route::get('/my-pets', [PetsController::class, 'mypets']);
    Route::get('/my-pets/{id}', [PetsController::class, 'getmypet']);
    Route::put('/my-pets/{id}', [PetsController::class, 'updatemypet']);
    Route::patch('/my-pets/{id}', [PetsController::class, 'updatePartialmypet']);

    Route::delete('/my-pets/{id}', [PetsController::class, 'destroy']);


});
//ADMIN ROUTES
Route::middleware([Isadmin::class])->group(function () {

    Route::get('users', [AuthController::class, 'indexUser']);
    Route::get('users/{id}', [AuthController::class, 'getUserById']);
    Route::put('users/{id}', [AuthController::class, 'updateUser']);
    Route::delete('users/{id}', [AuthController::class, 'deleteUser']);



});

