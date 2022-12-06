<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
			'number_id' => '1088351988',
			'name' => 'Brandon',
			'last_name' => 'Alvarez',
			'email' => 'b.palacio1@utp.edu.co',
			'password' => bcrypt(1234567890), // Función de Encriptación por Laravel
		]);
    }
}
