<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;
use App\Models\Enrollment;

class ShoppingController extends Controller
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
        //Se registra la matricula
        Enrollment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'role_id' => '5',
            'status' => 1,
        ]);

        //registramos datos de la compra
        Shopping::create([
            
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'status' => 1,

            'name' => $request->name,
            'last_name' => $request->last_name,
            'mothers_last_name' => $request->mothers_last_name,
            'address' => $request->address,

            'document' => $request->document,
            'telephone' => $request->telephone,
            'celular' => $request->celular,

            'address' => $request->address,
            'urbanizacion' => $request->urbanizacion,
            'country' => $request->country,
            'provincia' => $request->provincia,
            'city' => $request->city,
            'distrito' => $request->distrito,
        ]);
        
        $id = $request->course_id;
        
        if ($productos == null) {
            $producto = new Shopping();
            $producto->user_id = $request->user_id;
            $producto->course_id = $request->course_id;
            $producto->status = 2;

            $producto->save();

        }else{
            return 'Ya esta registrado';
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function show(Shopping $shopping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shopping $shopping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shopping $shopping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shopping $shopping)
    {
        //
    }
}
