<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\Shopping;
use App\Models\Enrollment;

use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

class CertificateController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show($certificate)
    {
        //
        //ubicamos la matricula conel Id matricula que nos llegga
        $matricula = Enrollment::findorFail($certificate);

        //ahora obtenemos e¡lso objetos de uruario y de curso
        $usuario = UserMoodle::where('user_moodle_id', $matricula->user_id)->first();
        $curso = Course::where('course_moodle_id', $matricula->course_id)->first();

        $img = Image::make('certificados/base.png');


        //detecto el ancho te la imagen, para determinar el centro de la misma
        $centro = $img->width()/2;

        $alumno_name = $usuario->name.', '.$usuario->last_name.$usuario->mothers_last_name;

        $img->text($alumno_name, $centro, 1292, function($font) {
            $font->file('font/Impact.ttf');
            $font->size(96);
            $font->color('#005267');
            $font->align('center');
            $font->valign('top');
            //$font->angle(45);
        });

        $texto = "Aprobó satifactoriamente el curso de Salud Mental del programa de apoyoa al segunda \n Especialidad de residencia médica, realizado desde el 28 de julio del 2020, con una duración de \n 72 horasy un valor académico de3,000 créditos, con una nota de 11.00";

        /*
        $img->text($texto, $centro, 1440, function($font) {
            $font->file('font/Times New Roman.ttf');
            $font->size(56);
            $font->color('#005267');
            $font->align('center');
            $font->valign('top');
            //$font->angle(45);
        });
        */

        $certificado = $img->response('jpg');

        dd($certificado);

        return view('certificates.index', compact('certificado'));

        //return view('certificates.index');
        // open an image file
    }


    public function searchCertificate(Request $request)
    {
        //

        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        //variables
        $course_moodle_id = $request->course_moodle_id;
        $user_moodle_id = $usuario->user_moodle_id;

        //echo $cursoId;

        //consultamos la modalidad del curso
        //si es post pago o prepago
        $modalidad = Course::where('course_moodle_id', $request->id)->first();


        //type 1 = PostPAgo
        //type 2 = Prepago

        //primero verificamos si el curso es Pre o postpago
        
        if ($modalidad->type == 1) {
            //es PostPago //debe de correr la pasrella de pagos
            return 1;

        }else{
            //es Prepago // el curso ya eta pagado puede descargar su certificado

            //Buscamos si el certificado ya se encuentra registrado
            $message = 'El certificado se generó con éxito, lo podras ver y descargar desde tu pagina de perfil';

            //$cursoMatriculado = DB::table('enrollments')->get();


            //buscar el ID del usuario y el ID del curso en la tabla Enrollment
            $enrollment_id = Enrollment::where('course_id', $course_moodle_id)
                                ->where('user_id', $user_moodle_id)
                                ->first();

            //registrar el certificado
            
            Certificate::create([
                'enrollment_id' => $enrollment_id->id,
                'status' => 1,
            ]);
            

            return $message;
        }
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificate $certificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificate $certificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        //
    }
}
