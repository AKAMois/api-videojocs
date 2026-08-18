<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

// Este archivo define todas las rutas de la API REST.
// Laravel prefija automáticamente con /api todo lo que hay aquí, así que:
//   Route::get('/videojocs') → accesible en GET http://localhost/api/videojocs

// IMPORTANTE: la ruta /cerca debe ir ANTES de /{id}
// Si no, Laravel interpretaría "cerca" como un ID y buscaría un videojuego con id="cerca"
Route::get('/videojocs/cerca',   [ApiController::class, 'cerca']);   // Buscar por género: /api/videojocs/cerca?genere=RPG

Route::get('/videojocs',         [ApiController::class, 'index']);   // Listar todos los videojuegos
Route::get('/videojocs/{id}',    [ApiController::class, 'show']);    // Ver un videojuego por su ID
Route::post('/videojocs',        [ApiController::class, 'store']);   // Crear un nuevo videojuego
Route::delete('/videojocs/{id}', [ApiController::class, 'destroy']); // Eliminar un videojuego por su ID
