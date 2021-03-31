<?php

namespace App\Http\Controllers;

use App\Models\UserMoodle;
use Illuminate\Http\Request;

class UserMoodleController extends Controller
{
    

     public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {   

        return Validator::make($data, [
            'document' => ['required', 'string', 'min:8' ,'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }
    
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
     * @param  \App\Models\UserMoodle  $userMoodle
     * @return \Illuminate\Http\Response
     */
    public function show(UserMoodle $userMoodle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMoodle  $userMoodle
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMoodle $userMoodle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMoodle  $userMoodle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMoodle $userMoodle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMoodle  $userMoodle
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMoodle $userMoodle)
    {
        //
    }
}
