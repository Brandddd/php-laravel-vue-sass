<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{

	protected $model = Book::class;   // Viene del models Book

	public function authorId($author)
	{
		return $this->state([    // El this->state lo que hace es coger el estado que sería el estado de los datos y se le inyecta el id del author
			'author_id' => $author->id,
		]);
	}

	public function definition()
	{
		return [
			'category_id' => $this->faker->randomElement([1, 2, 3]),   // Toma categorias Random.
			'title' => $this->faker->sentence(),   // Maximo dos palabras. Sentence()
			'stock' => $this->faker->randomDigit(),   // Coloca un digito random del stock randomDigit()
			'description' => $this->faker->paragraph(),  // Parrafo random paragraph()
		];
	}
}
