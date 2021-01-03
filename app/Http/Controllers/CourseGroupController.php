<?php

namespace App\Http\Controllers;

use App\Models\course_group;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;


class CourseGroupController extends Controller
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

        $grupos = course_group::all();
        return view('admin.grupos.index', compact('grupos', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        $grupos = course_group::all();
        return view('admin.grupos.create', compact('grupos', 'usuario'));

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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        course_group::create($request->all());

        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        $grupos = course_group::all();
        return view('admin.grupos.index', compact('grupos', 'usuario'));

        //return redirect()->route('admin.grupos.index');
            //->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\course_group  $course_group
     * @return \Illuminate\Http\Response
     */
    public function show(course_group $course_group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\course_group  $course_group
     * @return \Illuminate\Http\Response
     */
    public function edit(course_group $course_group)
    {
        //

        $grupo = course_group::find($course_group);

        dd($grupo);

        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        $grupo = course_group::where('id', $course_group)->first();

        dd($grupo);

        //return view('admin.grupos.edit', compact('usuario', 'course_group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\course_group  $course_group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, course_group $course_group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\course_group  $course_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(course_group $course_group)
    {
        //
    }
}
