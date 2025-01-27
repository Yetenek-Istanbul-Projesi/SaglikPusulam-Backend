<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'terms_accepted' => true,
            'privacy_accepted' => true
        ];
    }
} 