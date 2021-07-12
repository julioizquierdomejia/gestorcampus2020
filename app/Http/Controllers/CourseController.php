<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Tag;
use App\Models\Courseimage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;
use App\Models\CategoryCourseMoodle;
use App\Models\CourseSectionMoodle;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\Shopping;
use App\Models\Enrollment;
use App\Models\DocumentoCompbt;


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

        //validamos
        $request->validate([
            'instructor' => 'required',
            'introduccion' => 'required',
            'course_group_id' => 'required',
            'type' => 'required',
            'tags' => 'required',
            'price' => 'required|int',
            'img' => 'required',
            
        ],
        [
            'course_group_id.required' => 'Debes de elejir un Grupo para el curso a Crear',
            'type.required' => 'Selecciona la modalidad del cursos (PrePago / PostPago)',
            'instructor.required' => 'Ingresa el nombre del instructor',
            'tags.required' => 'Seleccione al menos una categoria',
            'price.required' => 'El curso debe de tener un costo',
            'img.required' => 'Seleccionar una imagen para el curso',

        ]);

        if ($request->hasFile('img')) {
            //$rules['File'] = ['max:2000','mimes:pdf,docx,doc'];

            //Capturamos la imagen que viene por el fomrulario
            $imagen = request()->file('img');
            $nombre_imagen =  time()."_".$imagen->getClientOriginalName();//Aqui se genera el nombre de la imagen

            //grabamos la imagen en el storage public
            Image::make($imagen)->encode('jpg', 20)->fit(500, 340)->save('images/images_cursos/'.$nombre_imagen);
        }
        


        //Caprutamos todos los tags y explotamos el array
        $tags_string = $request->tags;
        $tags = explode(",", $tags_string);

        //registramos a los instructores
        //en la tabla enrrolments con el valor 4 (teacher)
        $profes = $request->instructor;

        foreach ($profes as $key => $profe) {
            //obtenemos el usuario del campus de moodle
            $id_user_moodle = UserMoodle::where('user_id', $profe)->first();

            Enrollment::create([
                'user_id' => $id_user_moodle->user_moodle_id,
                'course_id' => $request->course_moodle_id,
                'role_id' => 4,
                'status' => 1,
            ]);

        }


        //Cargamos todas las categorias
        $catagorias = Category::all();
        
        //alamcenamos en una variable la categoria que viene del formulario
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

            //guardamos los datos del request en una variable
            $dataForm = $request->all();

            //convertimos el request instructor en string
            $dataForm['instructor'] = implode(',', $request->instructor);

            Course::create($dataForm);
            //Course::create($request->all()); //grabamos todos los datos del form a la tabla

            //Por medio de Id capturamos el curso que acabamos de grabar 
            $curso_current = Course::latest('id')->first();
            $curso_current->img = $nombre_imagen;
            $curso_current->save();

            
            //y creamos los tags que vengan del formulario y los amarramos a dicho curso
            //pero en la tabla de course_tag
            foreach ($tags as $key => $tag) {
                $curso_current->tags()->attach($tag);
            }



        }else{ //Si categorias tiene registros...entonces

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
                //buscamos el nombre de la categoria en la tabla de moodle 
                $categoria_request = CategoryCourseMoodle::findorFail($request->categoria);
                $nombre_categoria = $categoria_request->name;

                $nuevaCategoria = new Category;
                $nuevaCategoria->category_id = $request->categoria;
                $nuevaCategoria->name = $nombre_categoria;
                $nuevaCategoria->status = 1;

                $nuevaCategoria->save();

                //guardamos los datos del request en una variable
                $dataForm = $request->all();

                //convertimos el request instructor en string
                $dataForm['instructor'] = implode(',', $request->instructor);

                Course::create($dataForm);
                //Course::create($request->all()); //grabamos todos los datos del form a la tabla

                //Por medio de Id capturamos el curso que acabamos de grabar 
                $curso_current = Course::latest('id')->first();
                $curso_current->img = $nombre_imagen;
                $curso_current->save();

                
                //y creamos los tags que vengan del formulario y los amarramos a dicho curso
                //pero en la tabla de course_tag
                foreach ($tags as $key => $tag) {
                    $curso_current->tags()->attach($tag);
                }

                
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


        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        $curso_comprado = Shopping::where('user_id', $user_id)->first();

        //join para los datos del usuario
        $user = DB::table('users')
                ->join('usermoodles', 'users.id', 'usermoodles.user_id')
                ->select('users.*', 'usermoodles.*')
                ->first();

        $cursos = Course::all();
        $curso = Course::findorFail($course);

        $tags = DB::table('course_tag')->where('course_id', $curso->id)
                ->join('tags', 'course_tag.tag_id', '=', 'tags.id')
                ->get();

        //iteramos los instructores
        $ids_instructores = explode(',', $curso->instructor);

        $instructores = [];

        foreach ($ids_instructores as $key => $id_instructor) {
            $id = $id_instructor;
            $instructor = UserMoodle::where('user_id',$id)->first();

            //$instructores = Arr::add($instructores, $instructor);
            array_push($instructores, $instructor );

        }

        $misCursos = DB::table('enrollments')
                    ->join('usermoodles', 'enrollments.user_id', '=', 'usermoodles.user_moodle_id' )
                    ->join('courses', 'enrollments.course_id', '=', 'courses.course_moodle_id')
                    ->get();

        //preguntamos si el curso que estoy visitando
        //tiene alumnos matriculados
        $cursosTomados = Enrollment::where('course_id', $curso->course_moodle_id)->get();

        ///ahora recorremos los cursos tomados y verificamos
        //si figuro en alguno de esos cursos con mi $usuario->user_moodle_id
        
        $statusCourse = false; //adicional creo una variable boolean para el status de true or false

        foreach ($cursosTomados as $key => $cursoTomado) {
            if ($cursoTomado->user_id == $usuario->user_moodle_id) {
                $statusCourse = true;
            }else{
                $statusCourse = false;
            }
        }

        //$documents = DB::connection('mysql_moodle_sigen')->table('documento_compbt')->get();

        authenticated_moodle(\Auth::user()->email, \Auth::user()->password);
        
        return view('cursos.detallecurso', compact('curso', 'cursos', 'tags', 'user', 'curso_comprado', 'instructores', 'usuario', 'misCursos', 'statusCourse'));
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
 
        //listamos a todos os usuarios para la asignacion de maestros
        $usuarios = usermoodle::all();

        return view('admin.cursos.active', compact('usuario', 'cursos_moodle', 'secciones', 'cursos', 'course', 'grupos','tags', 'usuarios'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($course)
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
