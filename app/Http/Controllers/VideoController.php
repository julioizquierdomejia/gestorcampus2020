<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoType;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMoodle;
use App\Models\Competitor;
use App\Models\CompetitorType;

class VideoController extends Controller
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
        $usuario = UserMoodle::where('id', $user_id)->first();

        $videos = Video::all();


        

        return view('admin.videos.index', compact('videos', 'usuario'));
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
        $usuario = UserMoodle::where('id', $user_id)->first();

        $videos = Video::all();
        $users = UserMoodle::all();
        $competitor_types = CompetitorType::where('status', 1)->get();
        $video_types = VideoType::where('status', 1)->get();

        return view('admin.videos.create', compact('videos', 'usuario', 'users', 'video_types', 'competitor_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'competitor' => 'required|array',
        ];

        $this->validate($request, $rules);

        $competitors = $request->input('competitor');

        $video = Video::create($request->except(['competitor']));

        foreach ($competitors as $key => $item) {
            $competitor = Competitor::create([
                'user_id' => $item['user_id'],
                'video_id' => $video->id,
                'competitor_type_id' => $key
            ]);
        }

        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = UserMoodle::where('id', $user_id)->first();

        $videos = Video::all();
        return view('admin.videos.index', compact('videos', 'usuario'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
