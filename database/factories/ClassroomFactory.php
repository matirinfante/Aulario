<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'classroom_name' => $this->faker->numerify('Aula ##'),
            'location' => $this->faker->numerify('N #### W ####'),
            'capacity' => $this->faker->numberBetween(20, 100),
            'type' => $this->faker->randomElement(['Laboratorio', 'Aula Común']),
            'building' => $this->faker->randomElement(['Informática', 'Economía', 'Humanidades', 'Aulas comunes', 'Biblioteca']),
        ];
    }
}
