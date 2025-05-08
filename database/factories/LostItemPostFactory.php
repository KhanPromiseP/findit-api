<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LostItemPost>
 */
class LostItemPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" =>fake()->name(),
        "user_id" =>User::factory(),
        "location" =>   fake()->randomElement(['turkey','Cameroon','Canada']),//fake()->country(),
        "description" =>fake()->text(50),
        "category_id" =>Category::factory(),
        "status" =>fake()->randomElement(['lost','found']),
        "contact" =>fake()->phoneNumber(),
        "color" => fake()->randomElement(['red','blue','brown','orange']),//fake()->colorName(),
        ];
    }
}
