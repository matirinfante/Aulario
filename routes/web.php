<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/status', function () {
    return view('gantt.gantt');
})->name('gantt');

//Posible riesgo de seguridad !! Investigar
Route::post('/bookings/gantt', [BookingController::class, 'getClassroom'])->name('bookings.gantt');


Auth::routes();


Route::middleware(['auth'])->group(function () {

    Route::get('/bookings/admingantt', function () {
        return view('booking.adminGantt');
    })->name('bookings.admingantt');

    Route::get('/users/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::post('/users/changePassword', [UserController::class, 'changePassword'])->name('users.changePassword');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Reject petition route
    Route::patch('/petitions/reject/{petition}', [PetitionController::class, 'rejectPetition'])->name('petitions.reject');
//Mass toggle semester route
    Route::post('/assignments/semester', [AssignmentController::class, 'toggleSemester'])->name('assignments.toggle');
//RUTA Petición desde Bookings para evento masivo
    Route::post('/bookings/sendPetition', [BookingController::class, 'sendPetitionFromMessage'])->name('bookings.sendPetition');

//Check de logbook
    Route::post('/logbooks/check', [LogbookController::class, 'checkSign'])->name('logbook.check');
//Registrar check in
    Route::post('/logbooks/checkIn', [LogbookController::class, 'signCheckIn'])->name('logbook.checkin');
//Registrar check out
    Route::post('/logbooks/checkOut', [LogbookController::class, 'signCheckOut'])->name('logbook.checkout');
//Logbook historic
    Route::post('/logbooks/getlogbook', [LogbookController::class, 'getHistoryLogbook'])->name('logbook.getbydate');
//Period gen
    Route::post('/bookings/periods', [BookingController::class, 'getGaps'])->name('bookings.gaps');
    Route::post('/bookings/assignmentperiods', [BookingController::class, 'getClassroomsGaps'])->name('bookings.assignmentgaps');
//Classroom query for booking creation
    Route::post('/bookings/create/getrooms', [BookingController::class, 'getClassroomsByQuery'])->name('bookings.classrooms');
//MyBookings
    Route::get('/myBookings', [BookingController::class, 'myBookings'])->name('bookings.mybookings');
//AdminBookingCreation
    Route::get('/bookings/create/petition', [BookingController::class, 'createFromPetition'])->name('bookings.petition');
    Route::get('/bookings/admin/create', [BookingController::class, 'createAdmin'])->name('bookings.createAdmin');
    Route::post('/bookings/filter', [BookingController::class, 'classroomBookings'])->name('bookings.filter');

    Route::resources([
        'assignments' => AssignmentController::class,
        'bookings' => BookingController::class,
        'classrooms' => ClassroomController::class,
        'events' => EventController::class,
        'users' => UserController::class,
        'petitions' => PetitionController::class,
        'schedules' => ScheduleController::class,
        'logbooks' => LogbookController::class,
    ]);

    Route::put('/users/{user}', [UserController::class, 'activateUser'])->name('users.activate');
    Route::put('/assignments/{assignment}', [AssignmentController::class, 'activateAssignment'])->name('assignments.activate');
    Route::put('/classrooms/{classroom}', [ClassroomController::class, 'activateClassroom'])->name('classrooms.activate');
    Route::put('/events/{event}', [EventController::class, 'activateEvent'])->name('events.activate');
});

