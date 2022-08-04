<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
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
    public function definition()
    {
        return [
            'user_id' => random_int(100, 100),
            'title' => fake()->realTextBetween(70, 120),
            'content' => fake()->realTextBetween(200, 500),
            'image' => Post::DEFAULT_IMAGE_PATH,
        ];
    }

    /**
     * With User Model
     *
     * @return static
     */
    public function withUser()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::factory(),
            ];
        });
    }
}
