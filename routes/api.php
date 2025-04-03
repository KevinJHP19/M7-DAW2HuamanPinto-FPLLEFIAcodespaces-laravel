<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students', [StudentController::class,'index']);
Route::get('/students/{id}', [StudentController::class,'show']);

Route::post('/students', [StudentController::class,'store']);
Route::put('/students/{id}', [StudentController::class,'update']);
Route::delete('/students/{id}', [StudentController::class,'destroy']);

Route::post('/students', function (Request $request) {
    return "Creando estudiante";

});
Route::put('/students/{id}', function (Request $request, $id) {
    return "Actualizando estudiante con id: $id";
});
Route::delete('/students/{id}', function ($id) {
    return "Eliminando estudiante con id: $id";
});


