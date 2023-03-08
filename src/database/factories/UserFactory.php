<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'last_kana' => $this->faker->lastKanaName(),
            'first_kana' => $this->faker->firstKanaName(),
            'birthday' => $this->faker->date(),
            // 'sex' => $this->faker->lastName(),
            'zipcode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'street' => $this->faker->streetAddress(),
            // 'building' => $this->faker->lastName(),
            'tel' => $this->faker->phoneNumber(),
            // 'nearest_station' => $this->faker->lastName(),
            'self_intro' => $this->faker->realText(),
            'emergency_contact_name' => $this->faker->name(),
            // 'emergency_contact_relation' => $this->faker->lastName(),
            'emergency_contact_tel' => $this->faker->phoneNumber(),
            'firebase_user_id' => "",
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
