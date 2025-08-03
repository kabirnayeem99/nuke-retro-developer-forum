<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $techCategories = [
            'programming',
            'linux',
            'webdev',
            'opensource',
            'machinelearning',
            'androiddev',
            'datascience',
            'infosec',
            'devops',
            'selfhosted',
            'startup',
            'hardware',
            'ai',
            'productivity',
            'techpolicy',
            'sysadmin',
            'gamedev',
            'reverseengineering',
            'computerscience',
            'terminal'
        ];

        $name = $this->faker->unique()->randomElement($techCategories);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(8),
        ];
    }


}
