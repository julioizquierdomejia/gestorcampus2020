<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use App\Models\Group;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;
use App\Models\CourseCategoryMoodle;
use App\Models\Category;
use App\Models\Course;
use App\Models\Tag;
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
        $grupos = Group::all();
        $tags = Tag::all();

        $grupos_iterados = [];
        //iteramos los grupos de moodle para ver cuales se estan usando en cursos activos
        foreach ($grupos as $key => $item) {

            $grupo_activo = Course::where('course_group_id', $item->id)->first();

            if ($grupo_activo) {

                array_push($grupos_iterados, [$item->id, $item->name]);
            }
        }

        $cuorse_tags = DB::table('course_tag')
                ->join('tags', 'course_tag.tag_id', '=', 'tags.id')
                ->orderBy('course_tag.course_id', 'asc')
                ->get();
        
        return view('welcome', compact('cursos', 'roles', 'categorias', 'grupos_iterados', 'cuorse_tags', 'tags'));
    }
}
