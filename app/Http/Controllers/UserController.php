<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
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

	//--------------------- Consultas --------------------------
	public function getAllUsersWithLends()
	{
		// With -> todos los usuarios con prestamos
		// Con el With -> Has, solo trae los usuarios que tengan prestamos.
		$users = User::with('CustomerLends.Book')->has('CustomerLends.Book')->get();
		return response()->json(['users' => $users], 200);
	}

	// Consultar usuarios con libros prestados
	public function getAllLendsByUser(User $user)
	{
		//Debugging
		//ddd('Debugging');
		// CustomerLends viene de la relación en los Users.php la cual nos muestra los prestamos que adquirió el cliente además de traer sus respectivas relaciones
		$customerLends = $user->load('CustomerLends.Book.Category', 'CustomerLends.Book.Author')->CustomerLends; // Load me trae informacion de un objeto ya existente. en este cao el usuario al estar en memoria, para cargar mas informacion al usuario es Load()
		// La informacion que se pasa a javascript o de una api, el nombre de las variables debe ir en snake_case
		return response()->json(['customer_lends' => $customerLends], 200);
	}

	// Funcion de consulta a base de datos para obtener solo un usuario. Se le pasa el modelo y la variable a buscar en el modelo. Metodo magico de laravel. Se busca a través del ID.
	public function getAnUser(User $user)
	{
		return response()->json(['user' => $user], 200);
	}

	// Creando un usuario.
	// Para obtener el request se usa la funcion Request $request, que genera todos los datos del Request hecho desde el metodo post y los pasa a $request ya formateado.
	public function createUser(CreateUserRequest $request)
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
	public function updateUser(User $user, UpdateUserRequest $request)
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
