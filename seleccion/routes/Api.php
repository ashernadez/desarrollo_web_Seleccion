<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\JugadorController;

//rutas de jugador
Route::get('/Jugador', [JugadorController::class , 'index'] );

Route::get('/Jugador/{id}', [JugadorController::class, 'show']);

Route::post('/Jugador', [JugadorController::class, 'store']);

Route::put('/Jugador/{id}', [JugadorController::class, 'update']);

Route::patch('/Jugador/{id}', [JugadorController::class, 'updatePartial']);

Route::delete('/Jugador/{id}', [JugadorController::class, 'destroy']);

