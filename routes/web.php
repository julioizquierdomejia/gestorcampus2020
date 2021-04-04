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


/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/foto', function () {
    
	$img = Image::make('https://fondosmil.com/fondo/25194.jpg');
    return $img->response('jpg');

});

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'welcome'])->name('welcome');

Auth::routes();



Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

Route::get('/matricula', [App\Http\Controllers\EnrollmentController::class, 'index'])->name('matricula');
Route::get('/matricula/{id}', [App\Http\Controllers\EnrollmentController::class, 'getcursos'])->name('getcursos');
Route::get('/matriculacion/{id}', [App\Http\Controllers\EnrollmentController::class, 'domatricula'])->name('domatricula');

Route::get('/user/{name}', [App\Http\Controllers\UserController::class, 'search'])->name('buscar');

Route::get('/detallecurso/{id}', [App\Http\Controllers\CourseController::class, 'detail'])->name('curso.detail');
//Route::resource('/cursos', App\Http\Controllers\CourseController::class);
Route::get('videos/list', [App\Http\Controllers\VideoController::class, 'list'])->name('videos.list');
Route::middleware(['auth:' . config('admin-auth.defaults.guard')])->group(function () {

	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	
	Route::get('cursos', [App\Http\Controllers\CourseController::class, 'index'])->name('cursos');
	Route::get('cursos/{id}', [App\Http\Controllers\CourseController::class, 'show'])->name('curso.show');
	Route::get('cursos/{id}/activar', [App\Http\Controllers\CourseController::class, 'active'])->name('curso.active');
	Route::post('cursos', [App\Http\Controllers\CourseController::class, 'store'])->name('curso.store');
	Route::get('cursos/{id}/edit', [App\Http\Controllers\CourseController::class, 'edit'])->name('curso.edit');	
	Route::post('cursos/{id}', [App\Http\Controllers\CourseController::class, 'filtrar'])->name('curso.filtra');
	Route::put('/cursos/{id}', [App\Http\Controllers\CourseController::class, 'update'])->name('cursos.update');

	//routas para ver el perfil del usuario
	Route::get('perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil');

	//routes para los tags
	Route::resource('tags', App\Http\Controllers\TagController::class);

	//routes para los tags
	Route::resource('agrupacion', App\Http\Controllers\GrupoController::class);

	//routes para los Grupos
	Route::resource('grupos', App\Http\Controllers\GroupController::class);

	//routes para los videos
	Route::resource('videos', App\Http\Controllers\VideoController::class);

	//routes para los TIPO DE VIDEOS
	Route::resource('videostipos', App\Http\Controllers\VideoTypeController::class);

	//routes para el carrito de compras
	Route::resource('carrito', App\Http\Controllers\ShoppingCartController::class);

	//routes para el registro de compras
	Route::resource('shopping', App\Http\Controllers\ShoppingController::class);


});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');


//para detalle de cursos
/*
Route::get('/detallecurso/{id}', function () {
    return view('detallecurso');
});
*/

Route::get('/acercade', function () {
    return view('acercade');
});

