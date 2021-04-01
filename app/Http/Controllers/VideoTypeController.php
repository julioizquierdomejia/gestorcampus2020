<?php

namespace App\Http\Controllers;

use App\Models\VideoType;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;

class VideoTypeController extends Controller
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

        $videoTipos = VideoType::all();
        return view('admin.videotype.index', compact('videoTipos', 'usuario'));
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

        return view('admin.videotype.create', compact('usuario'));
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

        VideoType::create($request->all());

        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        $videoTipos = VideoType::all();
        return view('admin.videotype.index', compact('videoTipos', 'usuario'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoType  $video_type
     * @return \Illuminate\Http\Response
     */
    public function show(VideoType $video_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoType  $video_type
     * @return \Illuminate\Http\Response
     */
    public function edit($video_type)
    {
        //
        $tipoVideo = VideoType::findOrFail($video_type);
        
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

        return view('admin.videotype.edit', compact('tipoVideo', 'usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoType  $video_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoType $video_type)
    {
        //
        dd($video_type);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $video_type->update($request->all());

        return redirect()->route('videostipos.index')
            ->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoType  $video_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoType $video_type)
    {
        //
    }
}
