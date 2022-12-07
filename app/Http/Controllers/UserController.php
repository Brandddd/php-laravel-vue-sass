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

	// Funcion de consulta a base de datos para obtener solo un usuario. Se le pasa el modelo y la variable a buscar en el modelo. Metodo magico de laravel. Se busca a través del ID.
	public function getAnUser(User $user)
	{
		return response()->json(['user' => $user], 200);
	}

	// Creando un usuario.
	// Para obtener el request se usa la funcion Request $request, que genera todos los datos del Request hecho desde el metodo post y los pasa a $request ya formateado.
	public function createUser(Request $request)
	{
		// Creación del usuario: Le pasamos el request al modelo User, los cuales se encajan en el fillable de User.php y se almacen en la variable $user.
		$user = new User($request->all());
		// Con el metodo save() lo guardamos este $user nuevo en la base de datos.
		$user->save();
		// La funcion all() devuelve todos los atributos del request.
		return response()->json(['user' => $user], 201);
	}

	// Actualizando un Usuario.
	// Se trae el usuario $user de la base de datos, y se trae la data del request
	public function updateUser(User $user, Request $request)
	{
		$user->update($request->all()); // A este usuario se le actualiza toda la data enviada
		return response()->json(['user' => $user->refresh()], 201); // refresh() refrescar data del usuario, ya que el metodo PUT no esta pensado para mostrar data.
	}

	// Eliminando usuario
	public function deleteUser(User $user)
	{
		$user->delete();
		return response()->json([], 204); // 204 indica que se realizo la operacion con exito.
	}
}
