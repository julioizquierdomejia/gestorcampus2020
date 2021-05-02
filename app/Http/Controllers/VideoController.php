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
            'name' => 'required|string',
            'especialidad' => 'required|string',
            'tema' => 'required|string',
            'video_types_id' => 'required|string',
            'resumen' => 'required|string',
            'contenido' => 'required|string',
            'fecha' => 'required',
            'lugar' => 'required|string',
            'duracion' => 'required|string',
            'url' => 'required|string',
            'tipo_licencia' => 'required|string',
            'keys' => 'nullable|string',
            'competitor' => 'required|array',
        ];

        $messages = [
            'name.required' => 'El nombre del vídeo es requerido',
            'especialidad.required' => 'La especialidad del vídeo es requerida',
            'tema.required' => 'El tema del vídeo es requerido',
            'video_types_id.required' => 'El tipo de vídeo es requerido',
            'resumen.required' => 'El resumen de vídeo es requerido',
            'contenido.required' => 'El contenido de vídeo es requerido',
            'fecha.required' => 'La fecha de ejecución del vídeo es requerida',
            'lugar.required' => 'El lugar de vídeo es requerido',
            'duracion.required' => 'La duración de vídeo es requerida',
            'url.required' => 'La url de vídeo es requerida',
            'tipo_licencia.required' => 'El tipo de licencia es requerido',
            'competitor.required' => 'Los participantes son requeridos',
        ];

        $this->validate($request, $rules, $messages);

        $competitors = $request->input('competitor');

        $request->merge([
            'url' => str_replace("watch?v=", "embed/", $request->input('url'))
        ]);

        $video = Video::create($request->except(['competitor']));

        foreach ($competitors as $key => $item) {
            $competitor = [
                'user_id' => $item['user_id'],
                'video_id' => $video->id,
                'competitor_type_id' => $key
            ];
            Competitor::create($competitor);
        }

        /*$user_id = \Auth::user()->id; //auth()->id();
        $usuario = UserMoodle::where('id', $user_id)->first();*/

        $videos = Video::all();
        return redirect('videos');
    }

    public function list(Request $request)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $totalRecords = Video::count();

        $totalRecordswithFilter = Video::select('count(*) as allcount')
                ->where(function($query) use ($searchValue) {
                    $query->where('videos.name', 'like', '%'.$searchValue.'%');
                })
                ->count();

        $records = Video::skip($start)
                    ->take($rowperpage)
                    ->where(function($query) use ($searchValue) {
                        $query->where('videos.name', 'like', '%'.$searchValue.'%');
                    })
                    ->orderBy($columnName, $columnSortOrder)
                    ->get();

        $rows_array = [];


        function YoutubeID($url) {
            if(strlen($url) > 11) {
                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                    return $match[1];
                }
                else
                    return false;
            }
            return $url;
        }

        
        foreach ($records as $key => $video) {
            //$videoKey = $video->url;
            $videoKey = YoutubeID($video->url);

            $map_tags = array_map('trim', explode(',', $video->tags));

            $name = '<h5 class="card-title"><i class="fas fa-tag"></i> - '.$video->name.'</h5>';
            $description = '<p class="card-text">'.$video->description.'</p>';
            $url = '<div class="embed-responsive embed-responsive-16by9 mb-3">
                  <iframe class="embed-responsive-item bg-dark" src="'.$videoKey.'" allowfullscreen></iframe>
                </div>';
            $especialidad = '<p class="card-text">Especialidad: '.$video->especialidad.'</p>';
            $tema = '<p class="card-text"><i class="fa fa-comments" title="Tema"></i> '.$video->tema.'</p>';
            $contenido = '<div class="card-text mb-3">'.$video->contenido.'</div>';
            $fecha = '<p class="card-text"><i class="fa fa-calendar-day"></i> '.$video->fecha->format('d-m-Y').'</p>';
            $lugar = '<p class="card-text"><i class="fa fa-map-marker-alt"></i> '.$video->lugar.'</p>';
            $tipo_licencia = '<p class="card-text">Tipo de licencia: '.$video->tipo_licencia.'</p>';

            $competitors = '<p class="mb-0">Participantes</p>
                <ul class="list-inline bg-light p-2">';
                if ($video->competitors->count()) {
                    foreach ($video->competitors as $competitor) {
                        $competitors .= '<li class=""> - '.$competitor->user->name .' '.$competitor->user->last_name.' ('.$competitor->type->name.')</li>';
                    }
                } else {
                    $competitors .= '<li class="text-muted">No hay participantes.</li>';
                }
                $competitors .= '</ul>';
                $tags = '';
                if ($map_tags) {
                    $tags = '<p class="mb-0">Etiquetas</p>
                    <ul class="list-inline">';
                        foreach ($map_tags as $tag) {
                        $tags .= '<li class="d-inline-block"><span class="badge badge-primary px-2">'.$tag.'</span></li> ';
                        }
                    $tags .= '</ul>';
                }

            $rows_array[] = array(
              "id" => $video->id,
              "name" => $name,
              "description" => $description,
              "url" => $url,
              "especialidad" => $especialidad,
              "tema" => $tema,
              "contenido" => $contenido,
              "fecha" => $fecha,
              "lugar" => $lugar,
              "tipo_licencia" => $tipo_licencia,
              "competitors" => $competitors,
              "tags" => $tags,
            );
        };

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $rows_array
        );


        echo json_encode($response);
        exit;
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
        $user_id = \Auth::user()->id; //auth()->id();
        $usuario = UserMoodle::where('id', $user_id)->first();
        $users = UserMoodle::all();
        $competitors = Competitor::where('video_id', $video->id)->get();
        $competitor_types = CompetitorType::where('status', 1)->get();
        $video_types = VideoType::where('status', 1)->get();

        return view('admin.videos.edit', compact('video', 'usuario', 'users', 'video_types', 'competitor_types', 'competitors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $video_id)
    {
        $rules = [
            'name' => 'required|string',
            'especialidad' => 'required|string',
            'tema' => 'required|string',
            'video_types_id' => 'required|string',
            'resumen' => 'required|string',
            'contenido' => 'required|string',
            'fecha' => 'required',
            'lugar' => 'required|string',
            'duracion' => 'required|string',
            'url' => 'required|string',
            'tipo_licencia' => 'required|string',
            'keys' => 'nullable|string',
            'competitor' => 'required|array',
        ];

        $messages = [
            'name.required' => 'El nombre del vídeo es requerido',
            'especialidad.required' => 'La especialidad del vídeo es requerida',
            'tema.required' => 'El tema del vídeo es requerido',
            'video_types_id.required' => 'El tipo de vídeo es requerido',
            'resumen.required' => 'El resumen de vídeo es requerido',
            'contenido.required' => 'El contenido de vídeo es requerido',
            'fecha.required' => 'La fecha de ejecución del vídeo es requerida',
            'lugar.required' => 'El lugar de vídeo es requerido',
            'duracion.required' => 'La duración de vídeo es requerida',
            'url.required' => 'La url de vídeo es requerida',
            'tipo_licencia.required' => 'El tipo de licencia es requerido',
            'competitor.required' => 'Los participantes son requeridos',
        ];

        $this->validate($request, $rules, $messages);

        $competitors = $request->input('competitor');

        $request->merge([
            'url' => str_replace("watch?v=", "embed/", $request->input('url'))
        ]);

        $video = Video::where('id', $video_id)->firstOrFail();
        $video->update($request->except(['competitor']));

        Competitor::where('video_id', $video_id)->delete();
        foreach ($competitors as $key => $item) {
            $competitor = [
                'user_id' => $item['user_id'],
                'video_id' => $video_id,
                'competitor_type_id' => $key
            ];
            Competitor::create($competitor);
        }

        return redirect('videos');
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
