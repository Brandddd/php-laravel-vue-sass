<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
			// Para este caso se le añade el exception
			// Con el this->user->id se valida en toda la base de datos si ese id ya existe, sin mirar el id del user en el que se encuentra
			'number_id' => ['required', 'numeric', "unique:users,number_id,{$this->user->id}"], // Comillas dobles para atributo tipo variable
			'email' => ['required', 'email', "unique:users,email,{$this->user->id}"],
			// El nullable quiere decir que puede ser tomado o no.
			'password' => ['nullable', 'string', 'min:8', 'confirmed'],
		];
	}

	public function messages()
	{
		// Así se forman los mensajes personalizados a través de la función messages
		return [
			'name.required' => 'El nombre es requerido.',
			'name.string' => 'El nombre no es válido.',

			'last_name.required' => 'El apellido es requerido.',
			'last_name.string' => 'El apellido no es válido.',

			'number_id.required' => 'El documento es requerido.',
			'number_id.numeric' => 'El documento es inválido.',
			'number_id.unique' => 'El documento ya fue registrado.',

			'email.required' => 'El correo es requerido.',
			'email.email' => 'El correo debe de ser válido.',
			'email.unique' => 'Correo ya se encuentra registrado.',

			'password.required' => 'La contraseña es requerida.',
			'password.string' => 'Debe de ser valida.',
			'password.min' => 'La contraseña es muy corta.',
			'password.confirmed' => 'Las contraseñas no coinciden.',

		];
	}
}
