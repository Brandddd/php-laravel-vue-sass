<?php

namespace App\Http\Requests\Lend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLendRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
			'owner_user_id' => ['required', 'numeric', 'exists:users,id'],
			'customer_user_id' => ['required', 'numeric', 'exists:users,id'],
			'book_id' => ['required', 'numeric', 'exists:books,id'],
			'date_out' => ['required', 'date_format:Y-m-d'],
			'date_in' => ['required', 'date_format:Y-m-d'],
			'status' => ['required', 'in:lend,returned'],
        ];
    }

	public function messages()
	{
		// Así se forman los mensajes personalizados a través de la función messages
		return [
			'owner_user_id.required' => 'El ID del propietario es requerido.',
			'owner_user_id.numeric' => 'El id del propietario no es válido.',
			'owner_user_id.exists' => 'No existe este ID de propietario.',

			'customer_user_id.required' => 'El ID del cliente es requerido.',
			'customer_user_id.numeric' => 'El ID no es válido.',
			'customer_user_id.exists' => 'No existe este ID de cliente.',

			'book_id.required' => 'El ID del libro es requerido.',
			'book_id.numeric' => 'El id del libro debe ser numérico.',
			'book_id.exists' => 'No existe este libro.',

			'date_out.required' => 'La fecha de salida es requerida.',
			'date_out.date_format' => 'El formato de la fecha debe ser: yyyy/mm/dd',

			'date_in.required' => 'La fecha de entrada es requerida.',
			'date_in.date_format' => 'El formato de la fecha debe ser: yyyy/mm/dd.',

			'status.required' => 'El estado es requerido.',
			'status.in' => 'El estado debe ser lend o returned',
		];
	}
}
