<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
