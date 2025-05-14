<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'userID' => $this->faker->unique()->numberBetween(1000, 9999),
            'std_no' => $this->faker->unique()->numerify('20######'),
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // tüm kullanıcılar için sabit şifre
        ];
    }
}
