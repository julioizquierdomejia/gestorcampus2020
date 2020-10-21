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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

Route::get('/matricula', [App\Http\Controllers\EnrollmentController::class, 'index'])->name('matricula');

Route::get('/user/{name}', [App\Http\Controllers\UserController::class, 'search'])->name('buscar');

Route::get('/zoom', [App\Http\Controllers\ZoomController::class, 'index'])->name('zoom');
Route::get('/create-meeting', [App\Http\Controllers\ZoomController::class, 'create_meeting'])->name('create_meeting');
Route::get('/callback', [App\Http\Controllers\ZoomController::class, 'callback'])->name('callback');