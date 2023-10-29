<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Admin',
            'email' => $this->faker->email(),
            'password' => bcrypt('zxcv1234'),
            'role' => 'продавец',
            'sorting' => $this->faker->numberBetween(1, 999)
        ];
    }
}
