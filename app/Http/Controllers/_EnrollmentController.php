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
//<<<<<<< HEAD
            ->join('course_categories', 'course.category', '=', 'course_categories.id')
            ->where('course.visible', 1)
            ->select('course.id', 'course.fullname', 'course.shortname', 'course_categories.name')
            ->orderBy('course_categories.name', 'asc')
        	->get();        	

        //dd($cursosVisibles);

//=======
        	/*
            ->join('course_categories', 'course.category', 'course_categories.id')
        	->where('course.visible', 1)
            ->select('course.id', 'course.shortname', 'course_categories.name')
        	->get();
            */
//>>>>>>> tmp

        return view('matricula', compact('usuario', 'cursos', 'cursosVisibles'));
    }


    public function getcursos($userid){

         $cursosVisibles = DB::connection('mysql_moodle')->table('course')
            ->join('course_categories', 'course.category', 'course_categories.id')
            ->where('course.visible', 1)
            ->select('course.id', 'course.shortname', 'course_categories.name')
            ->get();
            

        return $cursosVisibles;
    }

    public function marticular($userid){
        
    }
}
