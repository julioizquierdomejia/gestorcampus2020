<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;
use App\Models\CourseCategoryMoodle;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function welcome()
    {

    	$cursos_moodle = CourseMoodle::all();
    	$cursos = Course::all();
        $categorias = Category::orderBy('name', 'asc')->get();
    	$roles = Role::all();
    	
        return view('welcome', compact('cursos', 'roles', 'categorias'));
    }
}
