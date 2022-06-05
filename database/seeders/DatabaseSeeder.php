<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        Permission::create(['name' => 'end bookings']); //cambiar el estado de la reserva
        Permission::create(['name' => 'see bookings']); //para ver sus propias reservas

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

        Permission::create(['name' => 'show users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'respirar']);

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
        $roleTeacher->givePermissionTo('see bookings');
        $roleTeacher->givePermissionTo('end bookings');

        $roleUser->givePermissionTo('create events');
        $roleUser->givePermissionTo('show events');
        $roleUser->givePermissionTo('delete events');
        $roleUser->givePermissionTo('create bookings');
        $roleUser->givePermissionTo('see bookings');
        $roleUser->givePermissionTo('end bookings');

        $roleBedel->givePermissionTo('respirar');
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

        $admin->assignRole('admin');


        Classroom::factory(10)->create();
        Event::factory(10)->create();
        Assignment::factory(10)->create();


    }
}
