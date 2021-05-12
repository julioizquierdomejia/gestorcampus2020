<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizCampusMoodle;
use App\Models\QuizGradeCampusMoodle;


use App\Models\Course;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;
use Illuminate\Support\Facades\DB;



class NotasController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($course)
    {
        //
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        //creamos la colecion de notas del curso de moodle
        $quiz = QuizCampusMoodle::where('course', $course)->get();

        //query para seleccionar las notas que hasta el momento tienen
        //segun las notas de la tabla quiz
        $notas=DB::connection('mysql_moodle')->table('quiz')
        		->join('quiz_grades', 'quiz.id', 'quiz_grades.quiz')
        		->where('quiz_grades.userid', $usuario->user_moodle_id)
        		->get();

        //Cantidad de notas que deben existir
        $cant_notas = $quiz->count();

        //Cantidad de notas que hay
        $cant_notas_existente = $notas->count();

        //variable para el status de generacion de certificados
        $statusCurso = false;

        if ($cant_notas_existente == $cant_notas) {
        	$statusCurso = true;
        }else{
        	$statusCurso = false;
        }


        $percent = ($cant_notas_existente * 100) / $cant_notas;


        return view('notas.index', compact('usuario', 'course', 'quiz', 'cant_notas', 'notas', 'cant_notas_existente', 'statusCurso', 'percent'));
    }
}
