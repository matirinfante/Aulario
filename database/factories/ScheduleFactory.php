<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $start = $this->faker->time('H:i:s', '20:00:00');
        return [
            'classroom_id' => $this->faker->numberBetween(1, 10),
            'day' => $this->faker->randomElement(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']),
            'start_time' => $start,
            'finish_time' => Carbon::createFromTimeString($start)->addHours(rand(1, 3)),
        ];
    }
}
