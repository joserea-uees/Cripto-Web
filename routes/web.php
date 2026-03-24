<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CryptoController;

Route::get('/', [CryptoController::class, 'index']);
Route::post('/buscar', [CryptoController::class, 'buscar']);
Route::get('/historial', [CryptoController::class, 'historial']);
Route::get('/descargar', [CryptoController::class, 'descargar']);