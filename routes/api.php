<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TarjetsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tarjets', [TarjetsController::class, 'index']);
Route::post('/tarjets', [TarjetsController::class, 'store']);
Route::get('/tarjets/{id}', [TarjetsController::class, 'show']);
Route::put('/tarjets/{id}', [TarjetsController::class, 'update']);
Route::patch('/tarjets/{id}', [TarjetsController::class, 'updatePartial']);
Route::delete('/tarjets/{id}', [TarjetsController::class, 'destroy']);


