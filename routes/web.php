<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

// Ruta para los roles y probra codigo
Route::get('/test', function () {
	// 2. Asignar roles a los usuarios:
	/* $users = User::get();
	foreach ($users as $user) {
		if ($user->number_id == 1088351988) $user->assignRole('admin');   // Asignacion admin role
		else $user->assignRole('user');   // Asignacion user role
	} */
	// 1. Asi creamos los roles, se accede a la ruta y se crea el rol en base de datos
	/* Role::create(['name' => 'admin']);
	Role::create(['name' => 'user']); */
});

// Ruta para mostrar los libros desde el controlador de BookController
Route::get('/', [BookController::class, 'showHomeWithBooks'])->name('home');


// ---------------------------------- Grupo para los usuarios: -------------------------------
// El middleware sirve para crear las rutas protegidas, que solo accedan los autentificados
// También se pueden agregar roles que puedan acceder a este grupo de rutas.
Route::group([
	'prefix' => 'Users', 'middleware' => ['auth', 'role:admin'],
	'controller' => UserController::class
], function () {
	Route::get('/', 'showAllUsers')->name('users'); /* Nombre para llamarlo desde menu.blade.php */
	Route::get('/CreateUser', 'showCreateUser')->name('user.create');
	// Recibe variable user, la cual corresponde al id del usuario que se desea editar
	Route::get('/EditUser/{user}', 'showEditUser')->name('user.edit');
	Route::post('/CreateUser', 'createUser')->name('user.create.post');
	Route::put('/EditUser/{user}', 'updateUser')->name('user.edit.put');
	Route::delete('/DeleteUser/{user}', 'deleteUser')->name('user.delete');
});

//--------------------------------- Grupo para los libros: -----------------------------------------
Route::group([
	'prefix' => 'Books', 'middleware' => ['auth', 'role:admin'],
	'controller' => BookController::class
], function () {
	// Este es el del home
	Route::get('/', 'showBooks')->name('books'); /* Nombre para llamarlo desde menu.blade.php */
	Route::post('/CreateBook', 'createBook'); // Crear libro desde el modal de vue
	Route::get('/GetAllBooks', 'getAllBooks');  // Leer todos los libros desde el modal de vue
	Route::get('/GetABook/{book}', 'getABook');  // Leer 1 libro para editarlo usando modal de vue
	Route::put('/UpdateBook/{book}', 'updateBook'); // Actualizado libro usando Vue
	Route::post('/UpdateBookFormData/{book}', 'updateBook'); // Actualizado libro usando Vue y formData DEBE SER POST
	Route::delete('/DeleteBook/{book}', 'deleteBook'); // Borrar libro usando Vue
});

// -------------------------------- Rutas para Authors ----------------------------------------------
Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function () {
	Route::get('/GetAllCategories', 'getAllCategories');
});

// -------------------------------- Rutas para Categories ----------------------------------------------
Route::group(['prefix' => 'Authors', 'controller' => AuthorController::class], function () {
	Route::get('/GetAllAuthors', 'getAllAuthors');
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
