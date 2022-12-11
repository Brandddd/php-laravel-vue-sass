<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'category_id' => ['required', 'numeric', 'exists:categories,id'],
			'author_id' => ['required', 'numeric', 'exists:authors,id'],
			'title' => ['required', 'string'],
			'stock' => ['required', 'numeric', 'integer'],
			'description' => ['required', 'string']
		];
	}

	public function messages()
	{
		return [
			'category_id.required' => 'El ID de la categoría es requerida.',
			'category_id.numeric' => 'El ID debe ser numérico.',
			'category_id.exists' => 'No se encuentra la categoría en la base de datos.',

			'author_id.required' => 'El ID de la autor es requerido.',
			'author_id.numeric' => 'El ID debe ser numérico.',
			'author_id.exists' => 'No se encuentra el autor en la base de datos.',

			'title.required' => 'El titulo del libro es requerido.',
			'title.string' => 'El titulo debe ser una cadena de texto.',

			'stock.required' => 'El stock es requerido.',
			'stock.numeric' => 'El stock debe ser un número.',
			'stock.integer' => 'El stock debe ser un número entero.',

			'description.required' => 'La descripción del libro es requerida.',
			'description.string' => 'La descripción debe ser de tipo texto.'
		];
	}
}
