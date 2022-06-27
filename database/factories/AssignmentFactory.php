<?php

namespace Database\Factories;

use Carbon\Carbon;
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
        $start_date = $this->faker->dateTimeThisYear('+2 months');
        $checked_date = Carbon::parse($start_date);
        if ($checked_date->locale('es')->dayName == 'domingo') {
            $start_date = $checked_date->addDay()->format('Y-m-d');
        }
        $finish_date = Carbon::parse($start_date)->addMonths(rand(2, 3));
        return [
            'assignment_name' => $this->faker->lexify('Materia ?'),
            'active' => $this->faker->boolean(60),
            'start_date' => $start_date,
            'finish_date' => $finish_date,
        ];
    }
}
