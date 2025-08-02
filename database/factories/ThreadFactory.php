<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6, true);
        return [
            'title' => $title,
            'body' => $this->faker->paragraphs(3, true),
            'slug' => \Str::slug($title) . '-' . $this->faker->unique()->randomNumber(4),
            'pinned' => false,
            'locked' => false,
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
