<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Group;
use App\Models\Tag;
use App\Models\Courseimage;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\UserCampusMoodle;
use App\Models\ShoppingCart;
use App\Models\Enrollment;
use App\Models\Certificate;

use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    //
    public function index()
    {

    	$user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first(); //datos del usuario moodle datos personales
        $user = user::where('id', $user_id)->first(); // datos del usuario del sitema correo y contraseña

        /*$misCursos = DB::table('shopping_carts')
            ->where('shopping_carts.user_id', '=', $user_id)
            ->join('courses', 'shopping_carts.course_id', '=', 'courses.id')
            ->select('courses.*', 'shopping_carts.id')
            ->get();
        */


        //recuperar el ID del usuario de moodle en la DB del gestor
        $id_user_moodle = $usuario->user_moodle_id;
        
        //seleccionar los cursos matriculados de la tabla enroolments

        $misCursos = DB::table('enrollments')
                    ->join('usermoodles', 'enrollments.user_id', '=', 'usermoodles.user_moodle_id' )
                    ->where('enrollments.user_id', $id_user_moodle)
                    ->join('courses', 'enrollments.course_id', '=', 'courses.course_moodle_id')
                    ->get();

        //listar los certificados de este usurio
        //hacemos un join entre las tablas matricula y tabla certificados
        $certificados = DB::table('enrollments')
                            ->join('certificates', 'enrollments.id', 'certificates.enrollment_id')->get();


        return view('perfil.index', compact('usuario', 'misCursos', 'user', 'certificados'));
    }

    public function update_datos(Request $request, $id){
        //

        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'last_name' => ['required', 'string', 'min:3'],
            'mothers_last_name' => ['required', 'string', 'min:3'],
        ]);


        $userMoodle = UserMoodle::findOrFail($id);

        $userMoodle->update($request->all());

        return redirect()->route('perfil')
            ->with('success', 'Registro actualizado');
    }


    public function update_user(Request $request, $id){
        //

        //validamos
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        //buscamos el usuario gestor por el ID
        $user = User::findOrFail($id);

        //actualizamos el pass del usuario gestor
        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);

        //buscamos el usuario en la DB de moodle
        $id_user_moodle = UserMoodle::where('user_id', $user->id)->first();


        //ubicamos el usuario moodle del campus
        $userMoodle = UserCampusMoodle::findOrFail($id_user_moodle->user_moodle_id);

        //actualizamos el pass del usuario del campus
        $userMoodle->update([
            'password' => bcrypt($request->input('password')),
        ]);


        return redirect()->route('perfil')
            ->with('success', 'Registro actualizado');
    }


}
