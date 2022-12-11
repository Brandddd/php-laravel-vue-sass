<?php

use App\Http\Controllers\BookController;
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
	// Traer todos los prestamos de libros a los usuarios
	Route::get('/GetAllLendsByUser/{user}', 'getAllLendsByUser');
	// Traer todos los usuarios con libros prestados
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

// -------------------------------- Rutas para Lend ----------------------------------------------
Route::group(['prefix' => 'Lends', 'controller' => LendController::class], function () {
	Route::post('/CreateLend', 'createLend');
	Route::put('/UpdateLend/{lend}', 'updateLend');
});

// -------------------------------- Rutas para Book ----------------------------------------------
Route::group(['prefix' => 'Books', 'controller' => BookController::class], function () {
	Route::post('/CreateBook', 'createBook'); // Create
	Route::get('/GetAllBooks', 'getAllBooks');  // Read all
	Route::get('/GetAnBook/{book}', 'getAnBook');  // Read 1
	Route::put('/UpdateBook/{book}', 'updateBook'); // Update
	Route::delete('/DeleteBook/{book}', 'deleteBook'); // Delete
});
