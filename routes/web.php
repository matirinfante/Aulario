<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\UserController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::patch('/petitions/reject/{petition}', [PetitionController::class, 'rejectPetition'])->name('petitions.reject');

Route::resources([
    'assignments' => AssignmentController::class,
    'bookings' => BookingController::class,
    'classrooms' => ClassroomController::class,
    'events' => EventController::class,
    'users' => UserController::class,
    'petitions' => PetitionController::class,
]);

Route::put('/users/{user}', [UserController::class, 'activateUser'])->name('users.activate');
Route::put('/assignments/{assignment}', [AssignmentController::class, 'activateAssignment'])->name('assignments.activate');

