<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'dni' => $this->faker->numberBetween(1000000, 60000000),
            'email' => $this->faker->unique()->email(),
            'password' => $this->faker->password(8), // password
            'user_uuid' => Uuid::uuid4(),
        ];
    }

}
