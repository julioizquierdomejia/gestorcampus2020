<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;
use App\Models\CategoryCourseMoodle;
use App\Models\CourseSectionMoodle;
use App\Models\Category;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();
        
        //Traemos categorias de moodle
        $categorias = CategoryCourseMoodle::where('visible', 1)->get();
    
        //Trameos los cursos creados en moodle
        $cursos_moodle = CourseMoodle::where('visible', 1)->get();

        $cursos = Course::where('status', 1)->get();

        //Preguntamos si la tala de cursos esta vacia con el modelo cursos
        if($cursos->count() == 0){
            $status = 0;
        }else{
            $status = 1;
        }

        return view('cursos.index', compact('usuario', 'cursos', 'cursos_moodle', 'categorias', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $catagorias = Category::all();
        $categoria = $request->categoria;

        //primero preguntamos si la tabla esta vacia
        if($catagorias->count() == 0){
            
            //buscamos el nombre de la categoria en la tabla de moodle 
            $categoria_request = CategoryCourseMoodle::findorFail($request->categoria);
            $nombre_categoria = $categoria_request->name;

            $nuevaCategoria = new Category;
            $nuevaCategoria->category_id = $request->categoria;
            $nuevaCategoria->name = $nombre_categoria;
            $nuevaCategoria->status = 1;

            $nuevaCategoria->save();

            Course::create($request->all()); //grabamos todos los datos del form a la tabla

        }else{

            //buscamos el nombre de la categoria en la tabla de moodle 
            $categoria_request = CategoryCourseMoodle::findorFail($request->categoria);
            $id_categoria = $categoria_request->id;

            $categoria_campus = Category::where('category_id', $id_categoria)->first();

            if($categoria_campus == null){
                //buscamos el nombre de la categoria en la tabla de moodle 
                $categoria_request = CategoryCourseMoodle::findorFail($request->categoria);
                $nombre_categoria = $categoria_request->name;

                $nuevaCategoria = new Category;
                $nuevaCategoria->category_id = $request->categoria;
                $nuevaCategoria->name = $nombre_categoria;
                $nuevaCategoria->status = 1;

                $nuevaCategoria->save();
            }else{
                
            }


            Course::create($request->all()); //grabamos todos los datos del form a la tabla

            

  
        }

  
        return redirect()->route('cursos')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($course)
    {
        //
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        //traemos la informacoin del curso de moodle
        $cursos_moodle =CourseMoodle::findorFail($course);
        //traemos las secciones del curso de moodle
        $secciones = CourseSectionMoodle::where('course', $course)->get();
        

        $cursos = Course::all();
        //dd($cursos);

        //Preguntamos si la tala de cursos esta vacia con el modelo cursos
        if($cursos->count()){
            $status = 0;
        }else{
            $status = 1;
        }

        
        

        return view('cursos.show', compact('usuario', 'cursos_moodle', 'secciones', 'cursos', 'status'));
    }

    public function detail($course){

        //$user_id = \Auth::user()->id; //auth()->id();
        //$usuario = usermoodle::where('id', $user_id)->first();

        $cursos = Course::all();
        $curso = Course::findorFail($course);

        return view('cursos.detallecurso', compact('curso', 'cursos'));
    }

    public function active($course)
    {
        //
        $cursos_moodle =CourseMoodle::findorFail($course);
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();
        $secciones = CourseSectionMoodle::where('course', $course)->get();
        $cursos = Course::where('status', 1)->get();

        return view('cursos.active', compact('usuario', 'cursos_moodle', 'secciones', 'cursos', 'course'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
