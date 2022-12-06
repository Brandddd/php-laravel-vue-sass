<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Los ID se crean en orden numérico de n a n+1, en este caso, 1,2,3,4
		//Categoría con ID 1:
		DB::table('categories')->insert([
			'name' => 'Terror',
		]);
		// Catergoría con ID 2:
		DB::table('categories')->insert([
			'name' => 'Comedia',
		]);
		// Catergoría con ID 3:
		DB::table('categories')->insert([
			'name' => 'Autos',
		]);
    }
}
