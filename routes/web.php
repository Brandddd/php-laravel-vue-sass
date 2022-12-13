<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Ruta para mostrar los libros desde el controlador de BookController
Route::get('/', [BookController::class, 'showHomeWithBooks'])->name('home');

// Grupo para los usuarios:
Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	Route::get('/', 'showAllUsers')->name('users'); /* Nombre para llamarlo desde menu.blade.php */
	Route::get('/CreateUser', 'showCreateUser')->name('user.create');
	// Recibe variable user, la cual corresponde al id del usuario que se desea editar
	Route::get('/EditUser/{user}', 'showEditUser')->name('user.edit');
	Route::post('/CreateUser', 'createUser')->name('user.create.post');
	Route::put('/EditUser/{user}', 'updateUser')->name('user.edit.put');
	Route::delete('/DeleteUser/{user}', 'deleteUser')->name('user.delete');
});

// Grupo para los libros:
Route::group(['prefix' => 'Books', 'controller' => BookController::class], function () {
	Route::get('/', 'showBooks')->name('books'); /* Nombre para llamarlo desde menu.blade.php */
	/* Route::get('/CreateUser', 'showCreateUser')->name('user.create'); */
	// Recibe variable user, la cual corresponde al id del usuario que se desea editar
	/* Route::get('/EditUser/{user}', 'showEditUser')->name('user.edit');
	Route::post('/CreateUser', 'createUser')->name('user.create.post');
	Route::put('/EditUser/{user}', 'updateUser')->name('user.edit.put');
	Route::delete('/DeleteUser/{user}', 'deleteUser')->name('user.delete'); */
});

// Se crea el grupo de routes, el cual recibe un array de atributos, en este caso una clase controlador
// y una función anónima, la cual va tener la rutas, que reciben el nombre $url, y a ese se le asigna el metodo
// que se va usar desde el controlador. Tambien se le debe asignar el name(), el cual se llamará desde a app.blade.php para hacer el llamado a la ruta.
Route::group(['controller' => LoginController::class], function () {
	// Login Routes...
	Route::get('login', 'showLoginForm')->name('login');
	Route::post('login', 'login');
	// Logout Routes...
	Route::post('logout', 'logout')->name('logout');
});

// Registration Routes...

Route::group(['controller' => ForgotPasswordController::class], function () {
	// Forgot Pasword reset routes...
	Route::get('password/reset', 'showLinkRequestForm')->name('password.request');

	Route::post('password/email', 'sendResetLinkEmail')->name('password.email');
});

Route::group(['controller' => ResetPasswordController::class], function () {
	// Password Reset Routes...
	Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');

	Route::post('password/reset', 'reset')->name('password.update');
});

Route::group(['controller' => ConfirmPasswordController::class], function () {
	// Password Confirmation Routes...
	Route::get('password/confirm', 'showConfirmForm')->name('password.confirm');
	Route::post('password/confirm', 'confirm');
});

Route::group(['controller' => VerificationController::class], function () {
	// Email Verification Routes...
	Route::get('email/verify', 'show')->name('verification.notice');
	Route::get('email/verify/{id}/{hash}', 'verify')->name('verification.verify');
	Route::post('email/resend', 'resend')->name('verification.resend');
});
