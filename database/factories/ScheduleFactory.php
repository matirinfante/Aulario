<?php

namespace Database\Factories;

use Carbon\Carbon;
use Carbon\CarbonInterval;
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
        $classroom_id = $this->faker->numberBetween(1, 10);
        $intervals = CarbonInterval::minutes(30)->toPeriod('08:00', '19:00');
        $fixedTimes = [];
        foreach ($intervals as $date) {
            $fixedTimes[] = $date->format('H:i');
        }
        $start = $this->faker->randomElement($fixedTimes);
        return [
            'classroom_id' => $classroom_id,
            'day' => $this->faker->randomElement(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']),
            'start_time' => $start,
            'finish_time' => Carbon::createFromTimeString($start)->addHours(rand(1, 3)),
        ];
    }
}
