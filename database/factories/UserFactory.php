<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{

	protected $model = User::class;   // Tabla a la que puede ir

    public function definition()
    {
        return [
			'number_id' => $this->faker->randomNumber(9, true),
            'name' => $this->faker->name(),
			'last_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),   // Creacion random fake data
            'password' => bcrypt(1234567890), // password
        ];
    }
}
