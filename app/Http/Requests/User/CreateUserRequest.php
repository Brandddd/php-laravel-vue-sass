<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
		// Para que los request funcionen hay que poner el return en true
		// Por defecto viene return false;
        return true;
    }

	// --------------------- Validaciones para creare user request --------------------------
	// Las reglas se encuentran en la documentación de Laravel.
    public function rules()
    {
		// Las validaciones se toman en ingles, si se quiere tomar un mensaje personalizado se crea una función
        return [
			// Los valores de 'string' y 'numeric' dependen del tipo de atributo, esto se ecuentra en la docuentación de laravel
			'name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
			'number_id' => ['required', 'numeric', 'unique:users,number_id'],
			// Para el unique: me mostrará 4 campos más, el primero es la tabla de donde se ecuentran todos los correos.
			// 2. es el nombre de la columna donde estan los correos en este caso email
			// 3. Es el error o exception si hay algun error, en este caso no se puso porque se pondrá en otro lugar.
			// 4. es el id de la exception.
			'email' => ['required', 'email', 'unique:users,email'],
			// Para el password, minimo de caracteres de 8, y debe ser un password confirmado.
			'password' => ['required', 'string', 'min:8','confirmed'],
			'role' => ['required'],
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

			'role.required' => 'El role del usuario es requerido.'
		];
	}
}
