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


        $notas=DB::connection('mysql_moodle')->table('quiz')
        		->join('quiz_grades', 'quiz.id', 'quiz_grades.quiz')
        		->where('quiz_grades.userid', $usuario->user_moodle_id)
        		->get();

        $cant_notas = $quiz->count();
        

        return view('notas.index', compact('usuario', 'course', 'quiz', 'cant_notas', 'notas'));
    }
}
