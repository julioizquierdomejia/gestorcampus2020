<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;
use App\Models\CategoryCourseMoodle;
use App\Models\CourseSectionMoodle;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

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

        $cursos_iterados = [];

        //iteramos los cursos de moodle para ver cuales esta activo en el gestor
        foreach ($cursos_moodle as $key => $item) {

            $curso_activo = Course::where('course_moodle_id', $item->id)->first();

            if ($curso_activo) {
                array_push($cursos_iterados, [$item->id, $item->shortname, 'ACTIVO', $item->category]);
            }else{
                array_push($cursos_iterados, [$item->id, $item->shortname, 'MOODLE', $item->category]);
            }
        }

        //dd($cursos_iterados);

        return view('admin.cursos.index', compact('usuario', 'cursos_moodle', 'categorias', 'cursos_iterados'));
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

        $imagen = request()->file('img');
        $nombre =  time()."_".$imagen->getClientOriginalName();
        dd($nombre);
        Image::make($imagen)->resize(300, 200)->save('foo.jpg');

        $tags_string = $request->tags;
        $tags = explode(",", $tags_string);

        $request->validate([
            'instructor' => 'required',
            'introduccion' => 'required',
            'course_group_id' => 'required',
            'type' => 'required',
            'tags' => 'required',
        ],
        [
            'course_group_id.required' => 'Debes de elejir un Grupo para el curso a Crear',
            'type.required' => 'Selecciona la modalidad del cursos (PrePago / PostPago)',
            'instructor.required' => 'Ingresa el nombre del instructor',
            'tags.required' => 'Seleccione al menos una categoria',
        ]);

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

            $curso_current = Course::latest('id')->first();
            
            foreach ($tags as $key => $tag) {
                $curso_current->tags()->attach($tag);
            }

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

            $curso_current = Course::latest('id')->first();
            
            foreach ($tags as $key => $tag) {
                $curso_current->tags()->attach($tag);
            }

  
        }

  
        return redirect()->route('cursos')
            ->with('success', 'Se ah Activado el Curso en el Gestor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($course)
    {
        //Aqui me trae el id del curso de la tabla de moodle

        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        //traemos la informacoin del curso de moodle
        $cursos_moodle = CourseMoodle::findorFail($course);
        //traemos las secciones del curso de moodle
        $secciones = CourseSectionMoodle::where('course', $course)->get();
        

        //listamos todos los cursos de la tabla del gestor
        $cursos = Course::all();


        //Preguntamos si la tabla de cursos esta vacia con el modelo cursos
        if($cursos->count()){
            $status = 0;
        }else{
            $status = 1;
        }

        $curso_activo = Course::where('course_moodle_id', $cursos_moodle->id)->first();

        if ($curso_activo) {
            $statusCurso = 'ACTIVO';
        }else{
            $statusCurso = 'MOODLE';
        }        

        return view('admin.cursos.info', compact('usuario', 'cursos_moodle', 'secciones', 'cursos', 'status', 'statusCurso', 'curso_activo'));
    }


    public function detail($course){

        //$user_id = \Auth::user()->id; //auth()->id();
        //$usuario = usermoodle::where('id', $user_id)->first();

        $cursos = Course::all();
        $curso = Course::findorFail($course);

        $tags = DB::table('course_tag')->where('course_id', $curso->id)
                ->join('tags', 'course_tag.tag_id', '=', 'tags.id')
                ->get();

        return view('cursos.detallecurso', compact('curso', 'cursos', 'tags'));
    }

    public function active($course)
    {
        //
        $cursos_moodle =CourseMoodle::findorFail($course);
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();
        $secciones = CourseSectionMoodle::where('course', $course)->get();
        $cursos = Course::where('status', 1)->get();

        $grupos = Group::all();
        $tags = Tag::all();

        return view('admin.cursos.active', compact('usuario', 'cursos_moodle', 'secciones', 'cursos', 'course', 'grupos','tags'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit( $course)
    {
        //
        $curso = Course::where('id', $course)->first();

        //$cursos_moodle =CourseMoodle::findorFail($course);

        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();
        $secciones = CourseSectionMoodle::where('course', $course)->get();
        $cursos = Course::where('status', 1)->get();

        $grupos = Group::all();
        $tags = Tag::all();

        //aqui obtenemos el nombre y el ID de a que grupo pertenece el grupo 
        $grupo_curso = Group::all()->where('id', $curso->course_group_id)->first();

        //obtendremos el tipo de curso si es postapago y prepago
        if ($curso->type == '1') {
            $nombre_type = "PostPago";
        }else{
            $nombre_type = "PrePago";
        }
        
        //recuperamos los tags
        $curso_current = Course::all()->where('id', $course)->first();
        $myTags = $curso_current->tags;


        return view('admin.cursos.edit', compact('usuario', 'secciones', 'cursos', 'grupos','tags', 'curso', 'grupo_curso', 'nombre_type', 'myTags'));

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
        
        $cursoCurrent = Course::findorFail($request->course_id);

        $request->validate([
            'instructor' => 'required',
            'introduccion' => 'required',
            'course_group_id' => 'required',
            'type' => 'required',
            'tags' => 'required',
        ],
        [
            'course_group_id.required' => 'Debes de elejir un Grupo para el curso a Crear',
            'type.required' => 'Selecciona la modalidad del cursos (PrePago / PostPago)',
            'instructor.required' => 'Ingresa el nombre del instructor',
            'tags.required' => 'Seleccione al menos una categoria',
        ]);

        $cursoCurrent->update($request->all());

        return redirect()->route('cursos')
            ->with('success', 'Se actualizo el curso');
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

    public function filtrar($tag)
    {
        $cursos = Course::whereHas('tags', function ($query) use ($tag) {
                    $query->where("tags.id", "=", $tag);
                })
                ->with('tags')
                ->get();

        return response()->json(['data' => $cursos, 'success' => true]);

    }
}
