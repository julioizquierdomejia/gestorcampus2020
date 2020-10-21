<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;
use Illuminate\Support\Facades\DB;


class EnrollmentController extends Controller
{
    //
    public function index(){

    	//
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();
        //$cursosVisibles = CourseMoodle::where('visible', 1)->get();
        $cursos = CourseMoodle::all();

        $cursosVisibles = DB::connection('mysql_moodle')->table('course')
        	->groupBy('category')
        	->where('visible', 1)
        	->get();        	

        dd($cursosVisibles);
        return view('matricula', compact('usuario', 'cursos', 'cursosVisibles'));
    }
}
