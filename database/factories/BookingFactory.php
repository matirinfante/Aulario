<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Event;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
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
        $type = rand(0, 1);
        $booking_date = $this->faker->dateTimeThisYear('+2 months');
        $week_day = Carbon::parse($booking_date)->locale('es')->dayName;
        if ($week_day == 'domingo') {
            $booking_date = Carbon::parse($booking_date)->addDay();
            $week_day = 'lunes';
        }
        $intervals = CarbonInterval::minutes(30)->toPeriod('08:00', '19:00');
        $fixedTimes = [];
        foreach ($intervals as $date) {
            $fixedTimes[] = $date->format('H:i');
        }
        $start = $this->faker->randomElement($fixedTimes);
        $classroom_id = Classroom::all()->random()->id;
        $check_availability = Schedule::where('classroom_id', $classroom_id)->where('day', ucfirst($week_day))->first();
        if (!$check_availability) {
            Schedule::create(['classroom_id' => $classroom_id, 'day' => ucfirst($week_day), 'start_time' => '08:00', 'finish_time' => '20:00']);
        } else {
            $availability = Schedule::findOrFail($check_availability->id);
            $availability->start_time = '08:00';
            $availability->finish_time = '20:00';
            $availability->save();
        }
        return [
            'user_id' => User::all()->random()->id,
            'classroom_id' => $classroom_id,
            'assignment_id' => $type ? Assignment::all()->random()->id : null,
            'event_id' => $type ? null : Event::all()->random()->id,
            'description' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'finished', 'cancelled']),
            'week_day' => $week_day,
            'booking_date' => $booking_date,
            'start_time' => $start,
            'finish_time' => Carbon::parse($start)->addHours(rand(1, 3)),
        ];
    }
}
