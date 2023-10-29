<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    public function definition(): array
    {
        return [
            "title" => ucfirst($this->faker->words(2, true)),
            "brand_id" => Brand::query()->inRandomOrder()->value('id'),
            "price" => $this->faker->numberBetween(1000, 100000),
            "description" => $this->faker->realText,
            "user_id" => User::query()->inRandomOrder()->value('id'),
            "thumbnail" => $this->faker->image,
            'sorting' => $this->faker->numberBetween(1, 999),
            'article' => $this->faker->numberBetween(1, 1000000)
        ];
    }
}
