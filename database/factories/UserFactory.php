<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Admin',
            'email' => 'plc-pro100@mail.ru',
            'password' => bcrypt('hello_world_1_1'),
            'role' => 'продавец',
            'sorting' => $this->faker->numberBetween(1, 999)
        ];
    }
}
