<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// En esta ruta vamos a llamar a un controlador.
// Grupo de rutas para el prefijo users. Todas las rutas que esten en users, siempre van a tener a users y a lo que se asigne dentro del grupo de rutas
// Si este es el controlador de users, se pone el controlador de users en este request.
Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	// Todas las rutas que se pongan acá dentro, irán al UserController.
	// Se crea la ruta que acceda a la función getAllUsers()
	// Se crea la ruta y se pone la función que se mostrará en esta ruta
	Route::get('/GetAllUsers', 'getAllUsers');		// GET -> Traer data

	Route::post('/GetAllUsers', 'getAllUsers');		// POST -> Crear data
	Route::put('/GetAllUsers', 'getAllUsers');		// PUT -> Actualizar data
	Route::delete('/GetAllUsers', 'getAllUsers');	// DELETE -> Eliminar data
});
