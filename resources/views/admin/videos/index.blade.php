@extends('layouts.app', ['title' => 'Tags'])
@section('content')
	
	<a href="{{ route('videos.create')}}" class="btn btn-primary"><i class="fal fa-layer-group"></i> Crear Video</a>
	<div class="row row-cols-1 row-cols-md-2 g-4 mt-5">
		@foreach($videos as $key => $video)

		<?php

			function YoutubeID($url){
				if(strlen($url) > 11){
					if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)){
							return $match[1];
						}
						else
							return false;
			            }
			            return $url;
			}
			        
			$videoKey = YoutubeID($video->url);
		?>


		  <div class="col">
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title"><i class="fas fa-tag"></i> - {{ $video->name }}</h5>
		        <p class="card-text">{{ $video->description }}</p>
		        

		        <div class="card-body">
		      	  	<div class="embed-responsive embed-responsive-16by9">
					  <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/{{$videoKey}}" allowfullscreen></iframe>
					</div>
				</div>


		        <div>
		        	<a href="{{route('tags.edit', $video->id)}}" class="btn btn-warning"><i class="fal fa-edit"></i> Editar</a>
		        	<a href="" class="btn btn-danger"><i class="fal fa-trash-alt"></i></a>
		        </div>
		      </div>
		    </div>
		  </div>
	  	@endforeach
	</div>
@endsection

