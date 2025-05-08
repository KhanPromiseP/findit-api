<?php

namespace Database\Factories;

use App\Models\LostItemPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LostItemImage>
 */
class LostItemImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_path' => '/local/1',
            'lost_item_post_id' => LostItemPost::factory(),
        ];
    }
}
