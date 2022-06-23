<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Booking;
use App\Models\Classroom;
use App\Models\Event;
use App\Models\Petition;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        //Crear permisos y agruparlos en roles
        //Actualmente hay solo 4 roles
        //admin = diosito mismo
        //teacher = crea peticiones, crea eventos, ve sus eventos y los cancela, crea reservas de eventos
        //user = crea eventos, ve sus eventos y los cancela, crea reservas de eventos
        //bedel = respira
        //No tocar

        //reset
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'show assignments']);
        Permission::create(['name' => 'create assignments']);
        Permission::create(['name' => 'edit assignments']);
        Permission::create(['name' => 'delete assignments']);

        Permission::create(['name' => 'show bookings']);
        Permission::create(['name' => 'create bookings']);
        Permission::create(['name' => 'edit bookings']);
        Permission::create(['name' => 'delete bookings']);
        Permission::create(['name' => 'cancel own bookings']); //cambiar el estado de la reserva
        Permission::create(['name' => 'see own bookings']); //para ver sus propias reservas

        Permission::create(['name' => 'show classrooms']);
        Permission::create(['name' => 'create classrooms']);
        Permission::create(['name' => 'edit classrooms']);
        Permission::create(['name' => 'delete classrooms']);

        Permission::create(['name' => 'show events']);
        Permission::create(['name' => 'create events']);
        Permission::create(['name' => 'edit events']);
        Permission::create(['name' => 'delete events']);

        Permission::create(['name' => 'show petitions']);
        Permission::create(['name' => 'create petitions']);
        Permission::create(['name' => 'edit petitions']);
        Permission::create(['name' => 'delete petitions']);
        Permission::create(['name' => 'reject petitions']);
        Permission::create(['name' => 'accept petitions']);

        Permission::create(['name' => 'show users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'show logbook']);
        Permission::create(['name' => 'edit logbook']);

        Permission::create(['name' => 'show schedule']);
        Permission::create(['name' => 'create schedule']);
        Permission::create(['name' => 'edit schedule']);
        Permission::create(['name' => 'delete schedule']);


        //Se crean los roles
        $roleAdmin = Role::create(['name' => 'admin']); //Bootea siendo supremo
        $roleTeacher = Role::create(['name' => 'teacher']);
        $roleUser = Role::create(['name' => 'user']);
        $roleBedel = Role::create(['name' => 'bedel']);

        //Se otorgan permisos
        $roleTeacher->givePermissionTo('show petitions');
        $roleTeacher->givePermissionTo('create petitions');
        $roleTeacher->givePermissionTo('create events');
        $roleTeacher->givePermissionTo('show events');
        $roleTeacher->givePermissionTo('delete events');
        $roleTeacher->givePermissionTo('create bookings');
        $roleTeacher->givePermissionTo('see own bookings');
        $roleTeacher->givePermissionTo('cancel own bookings');

        $roleUser->givePermissionTo('create events');
        $roleUser->givePermissionTo('show events');
        $roleUser->givePermissionTo('delete events');
        $roleUser->givePermissionTo('create bookings');
        $roleUser->givePermissionTo('see own bookings');
        $roleUser->givePermissionTo('cancel own bookings');

        $roleBedel->givePermissionTo('show bookings');
        $roleBedel->givePermissionTo('show logbook');
        $roleBedel->givePermissionTo('edit logbook');


        User::factory(10)->create();

        $users = User::all();
        foreach ($users as $user) {
            $user->assignRole('teacher');
        }

        $admin = User::factory()->create([
            'name' => 'Admin',
            'surname' => 'Superusuario',
            'dni' => 50123456,
            'email' => 'mail@admin.com',
            'password' => Hash::make('admin123'),
        ]);
        $teacher = User::factory()->create([
            'name' => 'Profesor',
            'surname' => 'X',
            'dni' => 50123455,
            'email' => 'mail@teacher.com',
            'password' => Hash::make('admin123'),
        ]);
        $user = User::factory()->create([
            'name' => 'Usuario',
            'surname' => 'X',
            'dni' => 50123458,
            'email' => 'mail@user.com',
            'password' => Hash::make('admin123'),
        ]);

        $admin->assignRole('admin');
        $teacher->assignRole('teacher');
        $user->assignRole('user');

        //A partir de acá se crean datos falsos de test
        Classroom::factory(10)->create();
        Event::factory(10)->create();
        Assignment::factory(20)->create();
        Petition::factory(10)->create();
        Schedule::factory(20)->create();


        $arrAssignments = Assignment::all();
        foreach ($arrAssignments as $assignment) {
            $intervals = CarbonInterval::minutes(30)->toPeriod('08:00', '19:00');
            $fixedTimes = [];
            foreach ($intervals as $date) {
                $fixedTimes[] = $date->format('H:i');
            }
            $start = Arr::random($fixedTimes);
            $finish = Carbon::parse($start)->addHours(rand(1, 3));
            $classroom_id = Classroom::all()->random()->id;
            $intervals = CarbonInterval::week()->toPeriod($assignment->start_date, $assignment->finish_date);
            foreach ($intervals as $date) {
                Booking::factory()->create([
                    'classroom_id' => $classroom_id,
                    'assignment_id' => $assignment->id,
                    'event_id' => null,
                    'week_day' => ucfirst($date->locale('es')->dayName),
                    'booking_date' => $date->format('Y-m-d'),
                    'start_time' => $start,
                    'finish_time' => $finish
                ]);
            }

        }

        Booking::factory(10)->create([
            'assignment_id' => null,
            'event_id' => rand(1, 10),
        ]);
        User::find(11)->assignments()->sync([2, 3]);
        User::find(1)->assignments()->sync(Classroom::find(2));
        User::find(2)->assignments()->sync(Classroom::find(4));
        //Fin datos falsos

        //Comienzo datos reales

        //Fin datos reales

    }
}
