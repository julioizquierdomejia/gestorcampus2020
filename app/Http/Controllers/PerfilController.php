<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Group;
use App\Models\Tag;
use App\Models\Courseimage;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\ShoppingCart;
use App\Models\Enrollment;

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
                    ->join('courses', 'enrollments.course_id', '=', 'courses.course_moodle_id')
                    ->get();

        return view('perfil.index', compact('usuario', 'misCursos', 'user'));
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

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user = User::findOrFail($id);

        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);


        return redirect()->route('perfil')
            ->with('success', 'Registro actualizado');
    }


}
