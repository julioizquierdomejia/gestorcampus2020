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
    }

    public function searchCertificate(Request $request)
    {
        //

        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        //echo $cursoId;

        //consultamos la modalidad del curso
        //si es post pago o prepago
        $modalidad = Course::where('course_moodle_id', $request->id)->first();

        //type 1 = PostPAgo
        //type 2 = Prepago

        //primero verificamos si el curso es Pre o postpago
        
        if ($modalidad->type == 1) {
            //es PostPago //debe de correr la pasrella de pagos
            return $usuario;

        }else{
            //es Prepago // el curso ya eta pagado puede descargar su certificado

            //Buscamos si el certificado ya se encuentra registrado
            $message = '';

            $cursoMatriculado = DB::table('enrollments')->get();

            return $cursoMatriculado;
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
