<?php

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


//Routes de Users
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('Ver Usuarios');
Route::get('/users-create', [App\Http\Controllers\UserController::class, 'create'])->name('Crear Usuarios');