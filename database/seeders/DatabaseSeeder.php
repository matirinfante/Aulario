<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Booking;
use App\Models\Classroom;
use App\Models\Event;
use App\Models\Logbook;
use App\Models\Petition;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Hashids\Hashids;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
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

        // User::factory(10)->create();
        // Comienzo datos reales
        $dataClassrooms = [
            [
                'classroom_name' => 'FAIF i1',
                'location' => '/assets/mapa_aulas/faif/FAIF_i1.png',
                'capacity' => '80',
                'type' => 'Aula común',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i2',
                'location' => '/assets/mapa_aulas/faif/FAIF_i2.png',
                'capacity' => '25',
                'type' => 'Laboratorio',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i3',
                'location' => '/assets/mapa_aulas/faif/FAIF_i3.png',
                'capacity' => '25',
                'type' => 'Laboratorio',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i4',
                'location' => '/assets/mapa_aulas/faif/FAIF_i4.png',
                'capacity' => '50',
                'type' => 'Aula común',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i5',
                'location' => '/assets/mapa_aulas/faif/FAIF_i5.png',
                'capacity' => '50',
                'type' => 'Aula común',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i6',
                'location' => '/assets/mapa_aulas/faif/FAIF_i6.png',
                'capacity' => '50',
                'type' => 'Laboratorio',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i7',
                'location' => '/assets/mapa_aulas/faif/FAIF_i7.png',
                'capacity' => '80',
                'type' => 'Aula común',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i8',
                'location' => '/assets/mapa_aulas/faif/FAIF_i8.png',
                'capacity' => '25',
                'type' => 'Laboratorio',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i9',
                'location' => '/assets/mapa_aulas/faif/FAIF_i9.png',
                'capacity' => '25',
                'type' => 'Laboratorio',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i10',
                'location' => '/assets/mapa_aulas/faif/FAIF_i10.png',
                'capacity' => '50',
                'type' => 'Aula común',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i11',
                'location' => '/assets/mapa_aulas/faif/FAIF_i11.png',
                'capacity' => '50',
                'type' => 'Aula común',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'FAIF i12',
                'location' => '/assets/mapa_aulas/faif/FAIF_i12.png',
                'capacity' => '50',
                'type' => 'Laboratorio',
                'building' => 'Informática',
            ], [
                'classroom_name' => 'AULA 101',
                'location' => '/assets/mapa_aulas/comunes/COMUNES_101.png',
                'capacity' => '80',
                'type' => 'Aula común',
                'building' => 'Aulas comunes',
            ],
            [
                'classroom_name' => 'AULA 102',
                'location' => '/assets/mapa_aulas/comunes/COMUNES_102.png',
                'capacity' => '80',
                'type' => 'Aula común',
                'building' => 'Aulas comunes',
            ], [
                'classroom_name' => 'AULA 105',
                'location' => '/assets/mapa_aulas/comunes/COMUNES_105.png',
                'capacity' => '150',
                'type' => 'Aula común',
                'building' => 'Aulas comunes',
            ],
            [
                'classroom_name' => 'AULA 106',
                'location' => '/assets/mapa_aulas/comunes/COMUNES_106.png',
                'capacity' => '300',
                'type' => 'Aula Común',
                'building' => 'Aulas comunes',
            ],
            [
                'classroom_name' => 'AULA 107',
                'location' => '/assets/mapa_aulas/comunes/COMUNES_107.png',
                'capacity' => '300',
                'type' => 'Aula común',
                'building' => 'Aulas comunes',
            ],
            [
                'classroom_name' => 'AULA 13',
                'location' => '/assets/mapa_aulas/facias/FACIAS_13.png',
                'capacity' => '300',
                'type' => 'Aula común',
                'building' => 'Humanidades',
            ],
            [
                'classroom_name' => 'AULA 17',
                'location' => '',
                'capacity' => '80',
                'type' => 'Aula común',
                'building' => 'Humanidades',
            ],
            [
                'classroom_name' => 'AULA 24',
                'location' => '/assets/mapa_aulas/facias/FACIAS_24.png',
                'capacity' => '100',
                'type' => 'Aula común',
                'building' => 'Humanidades',
            ],
            [
                'classroom_name' => 'AULA 25',
                'location' => '/assets/mapa_aulas/facias/FACIAS_25.png',
                'capacity' => '200',
                'type' => 'Aula común',
                'building' => 'Humanidades',
            ],
            [
                'classroom_name' => 'AULA 5',
                'location' => '',
                'capacity' => '120',
                'type' => 'Aula común',
                'building' => 'Economía',
            ],
            [
                'classroom_name' => 'AULA 6',
                'location' => '/assets/mapa_aulas/faea/FAEA_6.png',
                'capacity' => '120',
                'type' => 'Aula común',
                'building' => 'Economía',
            ],
            [
                'classroom_name' => 'AULA 45',
                'location' => '/assets/mapa_aulas/faea/FAEA_45.png',
                'capacity' => '48',
                'type' => 'Aula común',
                'building' => 'Economía',
            ],
            [
                'classroom_name' => 'AULA 44',
                'location' => '/assets/mapa_aulas/faea/FAEA_44.png',
                'capacity' => '48',
                'type' => 'Aula común',
                'building' => 'Economía',
            ],
            [
                'classroom_name' => 'AULA 41',
                'location' => '/assets/mapa_aulas/faea/FAEA_41.png',
                'capacity' => '48',
                'type' => 'Aula común',
                'building' => 'Economía',
            ],
            [
                'classroom_name' => 'AULA 53',
                'location' => '/assets/mapa_aulas/faea/FAEA_53.png',
                'capacity' => '48',
                'type' => 'Aula común',
                'building' => 'Economía',
            ],
            [
                'classroom_name' => 'LABORATORIO 1',
                'location' => '/assets/mapa_aulas/faea/FAEA_L1.png',
                'capacity' => '25',
                'type' => 'Laboratorio',
                'building' => 'Economía',
            ],
            [
                'classroom_name' => 'LABORATORIO 2',
                'location' => '/assets/mapa_aulas/faea/FAEA_L2.png',
                'capacity' => '25',
                'type' => 'Laboratorio',
                'building' => 'Economía',
            ],
            [
                'classroom_name' => 'LABORATORIO 3',
                'location' => '/assets/mapa_aulas/faea/FAEA_L3.png',
                'capacity' => '25',
                'type' => 'Laboratorio',
                'building' => 'Economía',
            ],
            [
                'classroom_name' => 'BOX 14',
                'location' => '',
                'capacity' => '48',
                'type' => 'Aula común',
                'building' => 'Economía',
            ],

        ];
        foreach ($dataClassrooms as $objClassroom) {
            Classroom::create($objClassroom);
        };

        $newHashid = new Hashids('aulario', 6, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $dataUser = [
            [
                'name' => 'Claudia',
                'surname' => 'Allan',
                'dni' => 3000000,
                'email' => 'claudia.allanFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Ana',
                'surname' => 'Alonso De Armiño,',
                'dni' => 3000001,
                'email' => 'ana.alonsoFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Marcelo',
                'surname' => 'Amaolo',
                'dni' => 3000002,
                'email' => 'marcelo.amaoloFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Silvia',
                'surname' => 'Amaro',
                'dni' => 3000003,
                'email' => 'silvia.amaroFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Federico',
                'surname' => 'Amigone',
                'dni' => 3000004,
                'email' => 'fe.amigoneFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Gabriela',
                'surname' => 'Aranda',
                'dni' => 3000005,
                'email' => 'fgabriela.arandaFalso@fi.uncoma.edu.ar ',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Natalia',
                'surname' => 'Baeza',
                'dni' => 3000006,
                'email' => 'natalia.baezaFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Javier',
                'surname' => 'Balladini',
                'dni' => 30000007,
                'email' => ' javier.balladiniFalso@fi.uncoma.edu,ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'German',
                'surname' => 'Braun',
                'dni' => 30000008,
                'email' => 'german.branFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Agustina',
                'surname' => 'Buccella',
                'dni' => 30000009,
                'email' => 'agustina.buccellaFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Rodrigo',
                'surname' => 'Cañibano',
                'dni' => 300000010,
                'email' => 'rcanibanoFalso@fi.uncoma.edu.ar ',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Laura Andrea',
                'surname' => 'Cecchi',
                'dni' => 300000011,
                'email' => 'lcecchiFalso@fi.uncoma.edu.ar ',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Susana Alejandra',
                'surname' => 'Cechich',
                'dni' => 300000012,
                'email' => 'alejandra.cechichFalso@fi.uncoma.edu.ar ',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Ignacio',
                'surname' => 'Ciruzzi',
                'dni' => 300000013,
                'email' => 'ignacio.ciruzziFalso@fi.uncoma.edu.ar ',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Sergio',
                'surname' => 'Cotal',
                'dni' => 300000014,
                'email' => 'sergio.cotalFalso@fi.uncoma.edu.ar ',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Marcos',
                'surname' => 'Cruz',
                'dni' => 300000015,
                'email' => ' marcos.cruzFalso@fi.uncoma.edu.ar  ',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Alan',
                'surname' => 'De Renzis',
                'dni' => 300000016,
                'email' => 'alanrenzisFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Daniel',
                'surname' => 'Dolz',
                'dni' => 300000017,
                'email' => 'ddolzFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Maria, Gladis',
                'surname' => 'Ferraro',
                'dni' => 30000018,
                'email' => 'gladis.ferraroFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Andrés',
                'surname' => 'Huayquil',
                'dni' => 30000028,
                'email' => 'andres.huayquilFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Pedro',
                'surname' => 'Landaveri',
                'dni' => 30000030,
                'email' => 'pedro.landaveriFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Nadina',
                'surname' => 'Martinez Carod',
                'dni' => 30000034,
                'email' => 'nadina.martinezFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Rodolfo',
                'surname' => 'Martinez',
                'dni' => 30000035,
                'email' => 'rodolfo.martinezFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Rafaela',
                'surname' => 'Mazalu',
                'dni' => 30000036,
                'email' => 'rafaela.mazaluFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Marina',
                'surname' => 'Moran',
                'dni' => 30000037,
                'email' => 'marinaFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Mario',
                'surname' => 'Moya',
                'dni' => 30000038,
                'email' => 'mario.moyaFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Marcelo',
                'surname' => 'Moyano',
                'dni' => 30000039,
                'email' => 'marcelo.moyanoFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Carina',
                'surname' => 'Noda',
                'dni' => 30000040,
                'email' => 'carina.nodalFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Gerardo',
                'surname' => 'Parra',
                'dni' => 30000041,
                'email' => 'gparraFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Viviana',
                'surname' => 'Pedrero',
                'dni' => 30000091,
                'email' => 'viviana.pedreroFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Susana Beatriz',
                'surname' => 'Parra',
                'dni' => 30000042,
                'email' => 'susana.parraFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Maria Laura',
                'surname' => 'Pino',
                'dni' => 30000043,
                'email' => 'maria.laura-pinoFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Matías',
                'surname' => 'Pol´la',
                'dni' => 30000044,
                'email' => 'matias.pollaFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Luis',
                'surname' => 'Reynoso',
                'dni' => 30000045,
                'email' => 'luis.reynosoFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Jorge Pablo',
                'surname' => 'Rodriguez',
                'dni' => 30000046,
                'email' => ' j.rodrigFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Sandra',
                'surname' => 'Roger',
                'dni' => 30000047,
                'email' => 'rogerFalso@fai.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Maria Jose',
                'surname' => 'Rotter',
                'dni' => 30000048,
                'email' => 'mariajoserotterFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Karina',
                'surname' => 'Rozas',
                'dni' => 30000049,
                'email' => 'karina.rozasFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Claudia',
                'surname' => 'Rozas',
                'dni' => 30000050,
                'email' => 'claudia.rozasFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Mauro',
                'surname' => 'Sagripanti',
                'dni' => 30000051,
                'email' => 'mauro.sagripantiFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Viviana',
                'surname' => 'Sanchez',
                'dni' => 30000052,
                'email' => 'viviana.sanchezFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Eliana',
                'surname' => 'Sandoval',
                'dni' => 30000053,
                'email' => 'eliana_sandovalFalso@hotmail.com',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Susana',
                'surname' => 'Sosa',
                'dni' => 30000054,
                'email' => 'susana.sosaFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Jorge',
                'surname' => 'Sznek',
                'dni' => 30000055,
                'email' => 'jorge.sznekFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Guillermo',
                'surname' => 'Torres',
                'dni' => 30000056,
                'email' => 'guillermo.torresFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Federico',
                'surname' => 'Uribe',
                'dni' => 30000057,
                'email' => 'ferico.uribeFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Claudia',
                'surname' => 'Valente Maria',
                'dni' => 30000058,
                'email' => 'claudia.valenteFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Claudio',
                'surname' => 'Vaucheret',
                'dni' => 30000059,
                'email' => 'vaucheretFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Adair',
                'surname' => 'Vilas Boas Martins',
                'dni' => 30000060,
                'email' => 'adair.martinsFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Claudio',
                'surname' => 'Zanellato',
                'dni' => 3000061,
                'email' => 'claudio.zanellatoFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Rafael',
                'surname' => 'Zurita',
                'dni' => 30000062,
                'email' => 'rzFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Andrés, Pablo',
                'surname' => 'Flores',
                'dni' => 30000020,
                'email' => 'andres.floresFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Javier',
                'surname' => 'Forquera',
                'dni' => 30000021,
                'email' => 'javier.forqueraFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Claudia Carina',
                'surname' => 'Fracchia',
                'dni' => 3000022,
                'email' => 'carina.fracchiaFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Martín',
                'surname' => 'Garriga',
                'dni' => 3000023,
                'email' => 'martin.garrigaFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Christian',
                'surname' => 'Giménez',
                'dni' => 3000024,
                'email' => 'christian.gimenezFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Ingrid',
                'surname' => 'Godoy',
                'dni' => 3000025,
                'email' => 'ingrid.godoyFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Guillermo',
                'surname' => 'Grosso',
                'dni' => 3000026,
                'email' => 'guillermo.grossoFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Gonzalo',
                'surname' => 'Heffesse',
                'dni' => 3000027,
                'email' => 'gheffesseFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Pablo',
                'surname' => 'Kogan',
                'dni' => 30000029,
                'email' => 'pablo.koganFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Miriam',
                'surname' => 'Lechner',
                'dni' => 3000331,
                'email' => 'mtlFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Marcela',
                'surname' => 'Leiva',
                'dni' => 3000032,
                'email' => 'marcela.leivaFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ], [
                'name' => 'Juan, Manuel',
                'surname' => 'Luzuriaga',
                'dni' => 3000033,
                'email' => 'juan.luzuriagaFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],
            [
                'name' => 'Valeria',
                'surname' => 'Zoratto',
                'dni' => 3000034,
                'email' => 'vzorattoFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica'),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))
            ],

        ];
        foreach ($dataUser as $value) {
            $objUser = User::create($value);
            $objUser->assignRole('teacher');
        };


        $dataMaterias = [
            [
                'assignment_name' => 'Adm. Servicios',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Adm. Sist. Avanzada',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ], [
                'assignment_name' => 'Adm. Sistemas',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ], [
                'assignment_name' => 'Agentes Inteligentes Web',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Almacenamiento y Analisis Big Data',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Analisis De Algoritmos',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ], [
                'assignment_name' => 'Analisis Diseño y Doc.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Aplicaciones Libres',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Arq. De Software',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Arq. y Org. De Computadoras I',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Arq. y Seg. De Computadoras',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Aspectos Profesionales y Soc.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Auditoria de Sist. de Info.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Automatizacion y Scripting',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Cálculo Numérico',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Complejidad Computacional',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Computacion',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Concep. Avanz. Leng. de Prog.',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Concep. Base de Datos',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Construc. y Val. de Software',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Sist. de Info. I',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Sist. de Info. II',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Sist. de Info. WEB',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Sist. de Info.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Sist. Inteligentes',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Sist. Operativos I',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Sist. Paralelos',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Software Libre',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Tec. Minería de Datos',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Tec. de Inf. Y Com.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Teoría de la Comput. I',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Teoría de la Comput. II',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Tópicos Avanz. CC de Comput.',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Trabajo Final Tec. Des. Web',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Verif. y Validación de Software',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Visual. de la Info.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ], [
                'assignment_name' => 'Dep y Minería de Datos',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Desarrollo de Algoritmos',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Didáctica específica',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Diseño de BD',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Diseño de Compiladores e Intérpretes',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Diseño de Planes de Negocios',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Diseño de Sis. Infor. para la Edu',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Diseño Gráfico',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Elem. de Teoria de la Comp.',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Elem. de Teoria de la Comp.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Esp. con Métodos Formales',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Esp. de Diseño de Software',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Esp. de Requerimientos',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Esp. de Software',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Estructura de Datos',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Framework e Interoperabilidad',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Gestion de BD',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Gestion de Proy. de Desarrollo Soft',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Ing de Requerimientos',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Inteligencia Artificial',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Intro a la Adm. de Sis.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Intro a la Comp.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Intro a la Comp. Tecnicatura',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Intro a la POO',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Intro. a la Prog.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Intro. a la Prog.',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Lab. Bases de datos',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Lab. Compiladores e Intérpretes',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Lab. Inteligencia Artificial',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Lab. Prog. Distribuida',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Lab. Programación',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Lab. Sist Info para Educación',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Lab. Tec Info y Com en la Educación',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Lenguajes Declarativos',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Log para Ciencias de la Comp',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Met Comp para el Cálculo',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Mod de Datos',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Mod Procesos Negocios',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Modelos y Sist Info.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Planificación y Control Proy',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Principios Leng Prog.',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Procesamiento Elec Datos',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Procesamiento Elec Datos',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Prog. Concurrente',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Prog. Sist Embebidos',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Prog. Estática y Lab. Web',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Prog. Orientada a Objetos',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Prog. Web Avanzada',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Prog. Web Dinámica',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Redes de Computadoras I',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Redes de Datos',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Redes II',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Residencia',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Reing Soft y Proc',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
            [
                'assignment_name' => 'Res Problemas y Alg',
                'active' => '1',
                'start_date' => '2022-03-14',
                'finish_date' => '2022-07-01',
            ],
            [
                'assignment_name' => 'Res Problemas y Alg',
                'active' => '0',
                'start_date' => '2022-08-08',
                'finish_date' => '2022-11-25',
            ],
        ];
        foreach ($dataMaterias as $objMateria) {
            Assignment::create($objMateria);
        }

        $dataSchedules = [
            [
                'classroom_id' => '18',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '11:00:00',
            ], [
                'classroom_id' => '18',
                'day' => 'Viernes',
                'start_time' => '10:00:00',
                'finish_time' => '14:00:00',
            ], [
                'classroom_id' => '20',
                'day' => 'Jueves',
                'start_time' => '12:00:00',
                'finish_time' => '15:00:00',
            ], [
                'classroom_id' => '20',
                'day' => 'Viernes',
                'start_time' => '18:00:00',
                'finish_time' => '20:00:00',
            ], [
                'classroom_id' => '19',
                'day' => 'Lunes',
                'start_time' => '20:30:00',
                'finish_time' => '23:00:00',
            ], [
                'classroom_id' => '19',
                'day' => 'Martes',
                'start_time' => '20:00:00',
                'finish_time' => '23:00:00',
            ], [
                'classroom_id' => '19',
                'day' => 'Miércoles',
                'start_time' => '21:00:00',
                'finish_time' => '23:00:00',
            ], [
                'classroom_id' => '19',
                'day' => 'Jueves',
                'start_time' => '17:00:00',
                'finish_time' => '23:00:00',
            ], [
                'classroom_id' => '19',
                'day' => 'Viernes',
                'start_time' => '12:00:00',
                'finish_time' => '14:00:00',
            ], [
                'classroom_id' => '22',
                'day' => 'Jueves',
                'start_time' => '09:00:00',
                'finish_time' => '12:00:00',
            ], [
                'classroom_id' => '23',
                'day' => 'Lunes',
                'start_time' => '09:00:00',
                'finish_time' => '13:00:00',
            ], [
                'classroom_id' => '26',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '17:00:00',
            ], [
                'classroom_id' => '26',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '13:00:00',
            ], [
                'classroom_id' => '26',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '17:00:00',
            ], [
                'classroom_id' => '26',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '13:00:00',
            ], [
                'classroom_id' => '26',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '13:00:00',
            ], [
                'classroom_id' => '24',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '12:00:00',
            ], [
                'classroom_id' => '27',
                'day' => 'Lunes',
                'start_time' => '09:00:00',
                'finish_time' => '12:00:00',
            ], [
                'classroom_id' => '27',
                'day' => 'Miércoles',
                'start_time' => '10:00:00',
                'finish_time' => '12:00:00',
            ],
            [
                'classroom_id' => '31',
                'day' => 'Martes',
                'start_time' => '18:00:00',
                'finish_time' => '21:00:00',
            ], [
                'classroom_id' => '25',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '10:00:00',
            ], [
                'classroom_id' => '25',
                'day' => 'Lunes',
                'start_time' => '13:00:00',
                'finish_time' => '16:00:00',
            ], [
                'classroom_id' => '25',
                'day' => 'Martes',
                'start_time' => '10:00:00',
                'finish_time' => '12:00:00',
            ], [
                'classroom_id' => '25',
                'day' => 'Miércoles',
                'start_time' => '13:00:00',
                'finish_time' => '16:00:00',
            ], [
                'classroom_id' => '1',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ], [
                'classroom_id' => '1',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ], [
                'classroom_id' => '1',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ], [
                'classroom_id' => '1',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '1',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '1',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '2',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '2',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '2',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '2',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '2',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '2',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '3',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '3',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '3',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '3',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '3',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '3',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '4',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '4',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '4',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '4',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '4',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '4',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '5',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '5',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '5',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '5',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '5',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '5',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '6',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '6',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '6',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '6',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '6',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '6',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '7',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '7',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '7',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '7',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '7',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '7',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '8',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '8',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '8',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '8',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '8',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '8',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '9',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '9',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '9',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '9',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '9',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '9',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '10',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '10',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '10',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '10',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '10',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '10',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '11',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '11',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '11',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '11',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '11',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '11',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '12',
                'day' => 'Lunes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '12',
                'day' => 'Martes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '12',
                'day' => 'Miércoles',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '12',
                'day' => 'Jueves',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '12',
                'day' => 'Viernes',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ],
            [
                'classroom_id' => '12',
                'day' => 'Sábado',
                'start_time' => '08:00:00',
                'finish_time' => '20:00:00',
            ]
        ];
        foreach ($dataSchedules as $objSchedule) {
            Schedule::create($objSchedule);
        };


        $users = User::all();
        foreach ($users as $user) {
            $user->assignRole('teacher');
        }
        // $newHashid = new Hashids('aulario', 6, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');


        $admin = User::factory()->create([
            'name' => 'Administrador',
            'surname' => '',
            'dni' => 50123456,
            'email' => 'aulario@fi.uncoma.edu.ar',
            'password' => Hash::make('admin123'),
            'user_uuid' => Uuid::uuid4(),
            'personal_token' => $newHashid->encode(50123456 + Carbon::now()->milliseconds + env('RND_KEY'))
        ]);
        $soporte = User::factory()->create([
            'name' => 'Soporte',
            'surname' => '',
            'dni' => 50123457,
            'email' => 'aulario-list@fi.uncoma.edu.ar',
            'password' => Hash::make('admin123'),
            'user_uuid' => Uuid::uuid4(),
            'personal_token' => $newHashid->encode(50123457 + Carbon::now()->milliseconds + env('RND_KEY'))
        ]);
        // $teacher = User::factory()->create([
        //     'name' => 'Profesor',
        //     'surname' => 'X',
        //     'dni' => 50123455,
        //     'email' => 'mail@teacher.com',
        //     'password' => Hash::make('admin123'),
        //     'user_uuid' => Uuid::uuid4(),
        //     'personal_token' => $newHashid->encode(50123455 + Carbon::now()->milliseconds + env('RND_KEY'))

        // ]);
        // $user = User::factory()->create([
        //     'name' => 'Usuario',
        //     'surname' => 'X',
        //     'dni' => 50123458,
        //     'email' => 'mail@user.com',
        //     'password' => Hash::make('admin123'),
        //     'user_uuid' => Uuid::uuid4(),
        //     'personal_token' => $newHashid->encode(50123458 + Carbon::now()->milliseconds + env('RND_KEY'))
        // ]);

        $admin->assignRole('admin');
        $soporte->assignRole('admin');
        // $teacher->assignRole('teacher');
        // $user->assignRole('user');

        // A partir de acá se crean datos falsos de test
        // Classroom::factory(10)->create();
        // Event::factory(10)->create();
        // // Assignment::factory(20)->create();
        // Petition::factory(10)->create();
        // Schedule::factory(20)->create();

        // $arrAssignments = Assignment::all();
        // foreach ($arrAssignments as $assignment) {
        //     $intervals = CarbonInterval::minutes(30)->toPeriod('08:00', '19:00');
        //     $fixedTimes = [];
        //     foreach ($intervals as $date) {
        //         $fixedTimes[] = $date->format('H:i');
        //     }
        //     $start = Arr::random($fixedTimes);
        //     $finish = Carbon::parse($start)->addHours(rand(1, 3));
        //     $classroom_id = Classroom::all()->random()->id;
        //     $intervals = CarbonInterval::week()->toPeriod($assignment->start_date, $assignment->finish_date);
        //     foreach ($intervals as $date) {
        //         $booking = Booking::factory()->create([
        //             'classroom_id' => $classroom_id,
        //             'assignment_id' => $assignment->id,
        //             'event_id' => null,
        //             'week_day' => ucfirst($date->locale('es')->dayName),
        //             'booking_date' => $date->format('Y-m-d'),
        //             'start_time' => $start,
        //             'finish_time' => $finish,
        //             'booking_uuid' => Uuid::uuid4()
        //         ]);
        //         Logbook::create([
        //             'booking_id' => $booking->id,
        //             'date' => $date->format('Y-m-d')]);
        //     }
        // }

        // Booking::factory(10)->create([
        //     'assignment_id' => null,
        //     'event_id' => rand(1, 10),
        // ]);


        /*User::find(11)->assignments()->sync([2, 3]);
        User::find(1)->assignments()->sync(Classroom::find(2));
        User::find(2)->assignments()->sync(Classroom::find(4));*/
        // Fin datos falsos

    }
}

;


