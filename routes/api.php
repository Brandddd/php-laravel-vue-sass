<?php

use App\Http\Controllers\LendController;
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
	// Para traer un usuario, la variable que se envia 'user' debe ser igual a la que le llega a la funcion en UserController en este caso $user.
	Route::get('/GetAnUser/{user}', 'getAnUser');		// GET -> Traer data
	// ! Traer todos los prestamos de libros a los usuarios. (Error 500)
	Route::get('/GetAllLendsByUser/{user}', 'getAllLendsByUser');
	// ! Traer todos los usuarios con libros prestados, (Error 500)
	Route::get('/GetAllUsersWithLends', 'getAllUsersWithLends');

	// Ruta para crear un usuario
	Route::post('/CreateUser', 'createUser');		// POST -> Crear data

	// Ruta para actualizar un usuario o editarlo.
	// Se asigna la variable user para trabajar sobre ese usuario en especifico.
	Route::put('/UpdateUser/{user}', 'updateUser');		// PUT -> Actualizar data

	// Ruta para eliminar un usuario de la base de datos.
	// Se asigna la variable user para borrar ese usuario en especifico.
	Route::delete('/DeleteUser/{user}', 'deleteUser');	// DELETE -> Eliminar data
});

Route::group(['prefix' => 'Lends', 'controller' => LendController::class], function () {
	Route::post('/CreateLend', 'createLend');
});
