<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home');

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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
