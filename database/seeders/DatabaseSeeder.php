<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeed;
use Database\Seeders\UserSeed;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
		$this->call([
			UserSeed::class,
			CategorySeed::class,   // Llamado de los seeders para proceder a su ejecución
		]);

		User::factory(10)->create();    // Del factory User, creeme 100 usuarios
		Author::factory(10)->create();    // Del factory Author, creeme 100 usuarios además de crear automaticamente 8 libros por autor.

    }
}
