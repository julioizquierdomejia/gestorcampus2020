<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;

class EnrollmentController extends Controller
{
    //
    public function index(){

    	//
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();
        $cursosVisibles = CourseMoodle::where('visible', 1)->get();
        $cursos = CourseMoodle::all();

        return view('matricula', compact('usuario', 'cursos', 'cursosVisibles'));
    }
}
