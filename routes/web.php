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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Reject petition route
    Route::patch('/petitions/reject/{petition}', [PetitionController::class, 'rejectPetition'])->name('petitions.reject');
//Mass toggle semester route
    Route::post('/assignments/semester', [AssignmentController::class, 'toggleSemester'])->name('assignments.toggle');
//RUTA TEST
    Route::get('/bookings/test', function () {
        return view('booking.test');
    });
    //Period gen
    Route::post('/bookings/periods', [BookingController::class, 'getGaps'])->name('bookings.gaps');
    //MyBookings
    Route::get('/myBookings', [BookingController::class, 'myBookings'])->name('bookings.mybookings');

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

