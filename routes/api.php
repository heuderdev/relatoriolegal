<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/buscar-empresa-email', [\App\Http\Controllers\ApiBuscarEmpresaEmailController::class, 'handle'])->name('api.buscar-empresa-email');
