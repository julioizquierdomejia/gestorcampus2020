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
    public function show(Certificate $certificate)
    {
        //
        
        $img = Image::make('certificados/base.png');

        $img->text('Julio Izquierdo Mejia', 0, 0, function($font) {
            $font->file('font/Impact.ttf');
            $font->size(124);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('top');
            $font->angle(45);
        });

        //return view('certificates.index');
        return $img->response('jpg');

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
