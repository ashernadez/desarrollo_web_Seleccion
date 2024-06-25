<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\JugadorController;
use App\Http\Controllers\Api\UsuarioController;

//rutas de jugador
Route::get('/Jugador', [JugadorController::class , 'index'] );
Route::get('/Jugador/{id}', [JugadorController::class, 'show']);
Route::post('/Jugador', [JugadorController::class, 'store']);
Route::put('/Jugador/{id}', [JugadorController::class, 'update']);
Route::patch('/Jugador/{id}', [JugadorController::class, 'updatePartial']);
Route::delete('/Jugador/{id}', [JugadorController::class, 'destroy']);

//rutas usuario
Route::get('/Usuario', [UsuarioController::class, 'index']);
Route::post('/Usuario', [UsuarioController::class, 'store']);
Route::get('/Usuario/{id}', [UsuarioController::class, 'show']);
Route::put('/Usuario/{id}', [UsuarioController::class, 'update']);
Route::patch('/Usuario/{id}', [UsuarioController::class, 'updatePartial']);
Route::delete('/Usuario/{id}', [UsuarioController::class, 'destroy']);