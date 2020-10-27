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
Route::get('/matricula/{id}', [App\Http\Controllers\EnrollmentController::class, 'getcursos'])->name('getcursos');
Route::get('/matriculacion/{id}', [App\Http\Controllers\EnrollmentController::class, 'domatricula'])->name('domatricula');

Route::get('/user/{name}', [App\Http\Controllers\UserController::class, 'search'])->name('buscar');

