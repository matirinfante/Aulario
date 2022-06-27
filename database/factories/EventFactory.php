<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'event_name' => $this->faker->numerify('Evento ###'),
            'user_id' => User::all()->random()->id,
            'participants' => $this->faker->numberBetween(10, 50)
        ];
    }
}
