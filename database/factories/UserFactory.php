<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $maleFirstNames = ['Ahmad', 'Hassan', 'Ali', 'Umar', 'Yusuf', 'Bilal', 'Abdullah', 'Salman', 'Tariq', 'Hamza'];
        $femaleFirstNames = ['Fatimah', 'Zainab', 'Aisha', 'Maryam', 'Khadijah', 'Sumayyah', 'Hafsa', 'Asma', 'Safiyyah', 'Ruqayyah'];
        $fathers = ['Abdullah', 'Ibrahim', 'Yunus', 'Usman', 'Hamid', 'Khalid', 'Zayd', 'Amr', 'Hisham', 'Talha'];

        $isMale = $this->faker->boolean;

        $firstName = $isMale
            ? $this->faker->randomElement($maleFirstNames)
            : $this->faker->randomElement($femaleFirstNames);

        $fatherName = $this->faker->randomElement($fathers);

        $fullName = $isMale
            ? "$firstName bin $fatherName"
            : "$firstName bint $fatherName";

        return [
            'name' => $fullName,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => $this->faker->randomElement(['member', 'moderator']),
            'bio' => $this->faker->optional()->text(100),
            'avatar' => $this->faker->optional()->imageUrl(640, 480, 'people', true, 'Avatar'),
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }


}
