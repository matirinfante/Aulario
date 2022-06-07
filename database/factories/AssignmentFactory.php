<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'assignment_name' => $this->faker->lexify('Materia ?'),
            'active' => $this->faker->boolean(60),
            'start_date' => $this->faker->date(),
            'finish_date' => $this->faker->date(),
        ];
    }
}
