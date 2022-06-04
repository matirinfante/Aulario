<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'surname' => 'Superusuario',
            'dni' => 50123456,
            'email' => 'mail@admin.com',
            'password' => Hash::make('admin123'),
        ]);

        Classroom::factory(10)->create();
        Event::factory(10)->create();
        Assignment::factory(10)->create();
    }
}
