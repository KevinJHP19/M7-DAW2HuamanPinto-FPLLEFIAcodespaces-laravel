<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', function (){
    return 'Lista de usuarios';
});
Route::post('/users', function (){
    return 'Crear usuario';
});
Route::put('/users/{id}', function (){
    return 'Actualizar usuario';
});
Route::delete('/users/{id}', function (){
    return 'Eliminar usuario';
});
Route::get('/users/{id}', function (){
    return 'Obtener un simple usuario';
});



