<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;

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
        //
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
