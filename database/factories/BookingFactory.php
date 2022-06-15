<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
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
            'user_id' => User::all()->random()->id,
            'classroom_id' => Classroom::all()->random()->id,
            'assignment_id' => Assignment::all()->random()->id,
            'event_id' => Event::all()->random()->id,
            'description' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'finished']),
            'week_day' => $this->faker->randomElement(['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', NULL]),
            'booking_date' => $this->faker->dateTimeThisYear('+2 months'),
            'start_time' => $start,
            'finish_time' => Carbon::createFromTimeString($start)->addHours(rand(1, 3)),
        ];
    }
}
