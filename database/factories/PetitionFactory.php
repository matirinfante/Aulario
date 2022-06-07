<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Petition>
 */
class PetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'assignment_id' => Assignment::all()->random()->id,
            'estimated_people' => $this->faker->numberBetween(20, 50),
            'classroom_type' => $this->faker->randomElement(['Laboratorio', 'Aula Común', 'Híbrido']),
            'start_time' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'finish_time' => $this->faker->time($format = 'H:i:s', $max = 'now'), //Como controla que sea despues de start?
            'start_date' => $this->faker->date(),
            'finish_date' => $this->faker->date(),
            'days' => $this->faker->randomElement(['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado']),
            'message' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'status' => $this->faker->randomElement(['unsolved', 'rejected', 'solved'])
        ];
    }
}
