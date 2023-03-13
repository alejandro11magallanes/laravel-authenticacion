<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignedRouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verificacion', function () {
    return view('Verificacion');
});

Route::get('/firmada',[SignedRouteController::class, 'generarVerificacion'], function (Request $request) {
    if (! $request->hasValidSignature()) {
        abort(401);
    }
    return view('Codigo');
})->name('firmada');


Route::get('/firmadaprueba', function (Request $request) {
    if (! $request->hasValidSignature()) {
        abort(401);
    }
    return "esta es una ruta firmada";
})->name('firmadaprueba');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['middelcodigo','auth'])->name('dashboard');

Route::middleware('auth','middelcodigo')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
