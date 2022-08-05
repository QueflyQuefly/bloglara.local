<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => random_int(1, 100),
            'post_id' => random_int(1, 100),
            'content' => fake()->realTextBetween(100, 250),
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

    /**
     * With Post Model
     *
     * @return static
     */
    public function withPost()
    {
        return $this->state(function (array $attributes) {
            return [
                'post_id' => Post::factory(),
            ];
        });
    }

    /**
     * With User and Post Model
     *
     * @return static
     */
    public function withUserAndPost()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::factory(),
                'post_id' => Post::factory(),
            ];
        });
    }
}
