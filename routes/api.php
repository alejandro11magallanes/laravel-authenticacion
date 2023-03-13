<?php

use App\Http\Controllers\NuevoCodigoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/enviocodigo', [NuevoCodigoController::class, 'validacion']);

Route::get('/saludo', function () {
    return response()->json(['mensaje' => 'Hola']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
