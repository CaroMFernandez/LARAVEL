<?php

use App\Http\Controllers\Equipos;
use App\Http\Controllers\Proyectos;
use App\Http\Controllers\Sprints;
use App\Http\Controllers\Tareas;
use App\Http\Controllers\Tickets;
use App\Http\Controllers\TareasTickets;
use App\Http\Controllers\Usuarios;
use App\Http\Controllers\Roles;
use App\Http\Controllers\EquipoUsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::apiResource('equipos', Equipos::class);
Route::apiResource('proyectos', Proyectos::class);
Route::apiResource('sprints', Sprints::class);
Route::apiResource('tareas', Tareas::class);
Route::apiResource('tickets', Tickets::class);
Route::apiResource('tareas_tickets', TareasTickets::class);
Route::apiResource('usuarios', Usuarios::class);
Route::apiResource('roles', Roles::class);
Route::post('equipos-usuarios', [EquipoUsuarioController::class, 'store']);
Route::delete('equipos-usuarios', [EquipoUsuarioController::class, 'destroy']);
Route::get('equipos-usuarios', [EquipoUsuarioController::class, 'index']);
Route::put('/equipos-usuarios', [EquipoUsuarioController::class, 'update']);
