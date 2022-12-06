<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

// En los controladores va TODA la lógica
class UserController extends Controller
{
	public function getAllUsers()
	{
		// Consulta a la base de datos, en este caso, vamos a llamar al modelo User para traer a todos los usuarios.
		// Con get() hacemos la consulta que me trae a todos los usuarios y se almacena en la variable $users.
		$users = User::get();
		// Pasar los datos, users de usuarios y $users que me tiene a todos los usuarios.
		// Los status 200 son status de obtención.
		return response()->json(['users' => $users], 200);
	}
}
