<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{

	protected $model = Author::class;  //Viene del models Author

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
			'biography' => $this->faker->paragraph(),   // Parrafo de letras totalmente random
        ];
    }

	// Creación función configure, esta función siempre se va ejecutar cuando se ejecuta un factory
	public function configure()
	{
		// Después de crear este factory, se creará 8 libros al author recién creado.
		return $this->afterCreating(function (Author $author) {
			Book::factory(2)->authorId($author)->create(); // authorId es una función que lleva facotry Book.
		});
	}
}
