<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uploaded_by' => fake()->username(),
            'user_id' => 1,
            'caption' => 'Lorem, belew beka yehe new caption.',
            'file_url' => 'post/me.jpg'
        ];
    }
}
