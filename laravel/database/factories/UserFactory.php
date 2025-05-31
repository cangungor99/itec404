<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'std_no'        => $this->faker->unique()->numerify('20######'),
            'name'          => $this->faker->firstName(),
            'surname'       => $this->faker->lastName(),
            'email'         => $this->faker->unique()->safeEmail(),
            'password'      => bcrypt('student123'), // varsayılan öğrenci şifresi
            'profile_photo' => null,
        ];
    }
}
