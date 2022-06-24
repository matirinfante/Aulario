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


        // User::factory(10)->create();

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
        // Classroom::factory(10)->create();
        // Event::factory(10)->create();
        // Assignment::factory(20)->create();
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
        //         Booking::factory()->create([
        //             'classroom_id' => $classroom_id,
        //             'assignment_id' => $assignment->id,
        //             'event_id' => null,
        //             'week_day' => ucfirst($date->locale('es')->dayName),
        //             'booking_date' => $date->format('Y-m-d'),
        //             'start_time' => $start,
        //             'finish_time' => $finish
        //         ]);
        //     }

        // }

        // Booking::factory(10)->create([
        //     'assignment_id' => null,
        //     'event_id' => rand(1, 10),
        // ]);
        // User::find(11)->assignments()->sync([2, 3]);
        // User::find(1)->assignments()->sync(Classroom::find(2));
        // User::find(2)->assignments()->sync(Classroom::find(4));
        //Fin datos falsos

        //Comienzo datos reales
        $dataUser = [
            [
              'name' => 'Claudia',
              'surname' => 'Allan',
              'dni' => 3000000,
              'email'=>'claudia.allanFalso@fi.uncoma.edu.ar',
              'password'=>Hash::make('informatica')
              
            ],
            [
                'name' => 'Ana',
                'surname' => 'Alonso De Armiño,',
                'dni' => 3000001,
                'email'=>'ana.alonsoFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
            
            ],
            [
                'name' => 'Marcelo',
                'surname' => 'Amaolo',
                'dni' =>  3000002,
                'email'=>'marcelo.amaoloFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
                
            ],[
                'name' => 'Amaro',
                'surname' => 'Silvia',
                'dni' =>  3000003,
                'email'=>'silvia.amaroFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
                
            ],[
                'name' => 'Federico',
                'surname' => 'Amigone',
                'dni' =>  3000004,
                'email'=>'fe.amigoneFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
                
            ],[
                'name' => 'Gabriel',
                'surname' => 'Aranda',
                'dni' =>  3000005,
                'email'=>'fgabriela.arandaFalso@fi.uncoma.edu.ar ',
                'password'=>Hash::make('informatica')
                
            ],[
                'name' => 'Natalia',
                'surname' => 'Baeza',
                'dni' => 3000006,
                'email'=>'natalia.baezaFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Javier',
                'surname' => 'Balladini',
                'dni' => 30000007,
                'email'=>' javier.balladiniFalso@fi.uncoma.edu,ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'German',
                'surname' => 'Braun',
                'dni' => 30000008,
                'email'=>'german.branFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Agustina',
                'surname' => 'Buccella',
                'dni' => 30000009,
                'email'=>'agustina.buccellaFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Rodrigo',
                'surname' => 'Cañibano',
                'dni' => 300000010,
                'email'=>'rcanibanoFalso@fi.uncoma.edu.ar ',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Laura',
                'surname' => 'Cecchi',
                'dni' => 300000011,
                'email'=>'lcecchiFalso@fi.uncoma.edu.ar ',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Alejandra',
                'surname' => 'Cechich',
                'dni' => 300000012,
                'email'=>'alejandra.cechichFalso@fi.uncoma.edu.ar ',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Ignacio',
                'surname' => 'Ciruzzi',
                'dni' => 300000013,
                'email'=>'ignacio.ciruzziFalso@fi.uncoma.edu.ar ',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Sergio',
                'surname' => 'Cotal',
                'dni' => 300000014,
                'email'=>'sergio.cotalFalso@fi.uncoma.edu.ar ',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Marcos',
                'surname' => 'Cruz',
                'dni' => 300000015,
                'email'=>' marcos.cruzFalso@fi.uncoma.edu.ar  ',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Alan',
                'surname' => 'De Renzis',
                'dni' => 300000016,
                'email'=>'alanrenzisFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Daniel',
                'surname' => 'Dolz',
                'dni' => 300000017,
                'email'=>'ddolzFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Maria, Gladis',
                'surname' => 'Ferraro',
                'dni' => 30000018,
                'email'=>'gladis.ferraroFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],
 		
 		    [
                'name' => 'Andrés',
                'surname' => 'Huayquil',
                'dni' => 30000028,
                'email'=>'andres.huayquilFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Pedro',
                'surname' => 'Landaveri',
                'dni' => 30000030,
                'email'=>'pedro.landaveriFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Nadina',
                'surname' => 'Martinez Carod',
                'dni' => 30000034,
                'email'=>'nadina.martinezFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Rodolfo',
                'surname' => 'Martinez',
                'dni' => 30000035,
                'email'=>'rodolfo.martinezFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Rafaela',
                'surname' => 'Mazalu',
                'dni' => 30000036,
                'email'=>'rafaela.mazaluFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Marina',
                'surname' => 'Moran',
                'dni' => 30000037,
                'email'=>'marinaFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Mario',
                'surname' => 'Moya',
                'dni' => 30000038,
                'email'=>'mario.moyaFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Marcelo',
                'surname' => 'Moyano',
                'dni' => 30000039,
                'email'=>'marcelo.moyanoFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Carina',
                'surname' => 'Noda',
                'dni' => 30000040 ,
                'email'=>'carina.nodalFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Gerardo',
                'surname' => 'Parra',
                'dni' =>  30000041,
                'email'=>'gparraFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Viviana',
                'surname' => 'Pedrero',
                'dni' => 30000091,
                'email'=>'viviana.pedreroFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Susana Beatriz',
                'surname' => 'Parra',
                'dni' => 30000042,
                'email'=>'susana.parraFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Maria Laura',
                'surname' => 'Pino',
                'dni' => 30000043,
                'email'=>'maria.laura-pinoFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Matías',
                'surname' => 'Pol´la',
                'dni' => 30000044,
                'email'=>'matias.pollaFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Luis',
                'surname' => 'Reynoso',
                'dni' =>30000045,
                'email'=>'luis.reynosoFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Jose',
                'surname' => 'Rodriguez',
                'dni' =>30000046,
                'email'=>' j.rodrigFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Sandra',
                'surname' => 'Roger',
                'dni' =>30000047,
                'email'=>'rogerFalso@fai.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Maria Jose',
                'surname' => 'Rotter',
                'dni' =>30000048,
                'email'=>'mariajoserotterFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Karina',
                'surname' => 'Rozas',
                'dni' => 30000049,
                'email'=>'karina.rozasFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Claudia',
                'surname' => 'Rozas',
                'dni' => 30000050,
                'email'=>'claudia.rozasFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Mauro',
                'surname' => 'Sagripanti',
                'dni' => 30000051,
                'email'=>'mauro.sagripantiFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Viviana',
                'surname' => 'Sanchez',
                'dni' => 30000052,
                'email'=>'viviana.sanchezFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Eliana',
                'surname' => 'Sandoval',
                'dni' => 30000053,
                'email'=>'eliana_sandovalFalso@hotmail.com',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Susana',
                'surname' => 'Sosa',
                'dni' => 30000054,
                'email'=>'susana.sosaFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],
            [
                'name' => 'Jorge',
                'surname' => 'Sznek',
                'dni' => 30000055,
                'email'=>'jorge.sznekFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
               
            ],[
                'name' => 'Guillermo',
                'surname' => 'Torres',
                'dni' => 30000056,
                'email' => 'guillermo.torresFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica')
              ],
              [
                'name' => 'Federico',
                'surname' => 'Uribe',
                'dni' => 30000057,
                'email' => 'ferico.uribeFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica')
              ],
              [
                'name' => 'Claudia',
                'surname' => 'Valente Maria',
                'dni' => 30000058,
                'email' => 'claudia.valenteFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica')
              ],
              [
                'name' => 'Claudio',
                'surname' => 'Vaucheret',
                'dni' => 30000059,
                'email' => 'vaucheretFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica')
              ],
              [
                'name' => 'Adair',
                'surname' => 'Vilas Boas Martins',
                'dni' => 30000060,
                'email' => 'adair.martinsFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica')
              ],
              [
                'name' => 'Claudio',
                'surname' => 'Zanellato',
                'dni' => 3000061,
                'email' => 'claudio.zanellatoFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica')
              ],
              [
                'name' => 'Rafael',
                'surname' => 'Zurita',
                'dni' => 30000062,
                'email' => 'rzFalso@fi.uncoma.edu.ar',
                'password' => Hash::make('informatica')
              ],
            [
                'name' => 'Andrés, Pablo',
                'surname' => 'Flores',
                'dni' => 30000020,
                'email'=>'andres.floresFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
              
            ],
            [
                'name' => 'Javier',
                'surname' => 'Forquera',
                'dni' => 30000021,
                'email'=>'javier.forqueraFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
              
            ],
            [
                'name' => 'Karina',
                'surname' => 'Fracchia',
                'dni' => 3000022,
                'email'=>'carina.fracchiaFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
              
            ],         
            [
                'name' => 'Martín',
                'surname' => 'Garriga',
                'dni' => 3000023,
                'email'=>'martin.garrigaFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
              
            ],
            [
                'name' => 'Christian',
                'surname' => 'Giménez',
                'dni' => 3000024,
                'email'=>'christian.gimenezFalso@fi.uncoma.edu.ar',
                'password'=>Hash::make('informatica')
              
            ],
                    [
                        'name' => 'Ingrid',
                        'surname' => 'Godoy',
                        'dni' => 3000025,
                        'email'=> 'ingrid.godoyFalso@fi.uncoma.edu.ar',
                        'password'=> Hash:: make('informatica')
  
                    ], [
                        'name' => 'Guillermo',
                        'surname' => 'Grosso',
                        'dni' => 3000026,
                        'email'=> 'guillermo.grossoFalso@fi.uncoma.edu.ar',
                        'password'=> Hash:: make('informatica')
  
                    ], [
                        'name' => 'Gonzalo',
                        'surname' => 'Heffesse',
                        'dni' => 3000027,
                        'email'=> 'gheffesseFalso@fi.uncoma.edu.ar',
                        'password'=> Hash:: make('informatica')
  
                    ],  [
                        'name' => 'Pablo',
                        'surname' => 'Kogan',
                        'dni' => 30000029,
                        'email'=> 'pablo.koganFalso@fi.uncoma.edu.ar',
                        'password'=> Hash:: make('informatica')
  
                    ],[
                        'name' => 'Miriam',
                        'surname' => 'Lechner',
                        'dni' => 3000331,
                        'email'=> 'mtlFalso@fi.uncoma.edu.ar',
                        'password'=> Hash:: make('informatica')
  
                    ], [
                        'name' => 'Marcela',
                        'surname' => 'Leiva',
                        'dni' => 3000032,
                        'email'=> 'marcela.leivaFalso@fi.uncoma.edu.ar',
                        'password'=> Hash:: make('informatica')
  
                    ], [
                        'name' => 'Juan, Manuel',
                        'surname' => 'Luzuriaga',
                        'dni' => 3000033,
                        'email'=> 'juan.luzuriagaFalso@fi.uncoma.edu.ar',
                        'password'=> Hash:: make('informatica')
  
                    ]

          ];
      
          foreach ($dataUser as $value) {
            $objUser=User::create($value);
            $objUser->assignRole('teacher');
          };
    
        //Fin datos reales

}};

