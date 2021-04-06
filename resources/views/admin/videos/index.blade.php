@extends('layouts.app', ['title' => 'Vídeos'])
@section('content')
	
	<a href="{{ route('videos.create')}}" class="btn btn-primary"><i class="fal fa-layer-group"></i> Crear Video</a>
	<div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
		@foreach($videos as $key => $video)
		<?php
			//$videoKey = str_replace("watch?v=", "embed/", $video->url);
			$tags = array_map('trim', explode(',', $video->tags));
		?>

		  <div class="col">
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title"><i class="fas fa-tag"></i> - {{ $video->name }}</h5>
		        <p class="card-text">{{ $video->description }}</p>
	      	  	<div class="embed-responsive embed-responsive-16by9 mb-3">
				  <iframe class="embed-responsive-item bg-dark" src="{{$video->url}}" allowfullscreen></iframe>
				</div>
				<p class="card-text">Especialidad: {{ $video->especialidad }}</p>
				<p class="card-text"><i class="fa fa-comments" title="Tema"></i> {{ $video->tema }}</p>
				<div class="card-text mb-3">{!! $video->contenido !!}</div>
				<p class="card-text"><i class="fa fa-calendar-day"></i> {{ $video->fecha->format('d-m-Y') }}</p>
				<p class="card-text"><i class="fa fa-map-marker-alt"></i> {{ $video->lugar }}</p>
				<p class="card-text">Tipo de licencia: {{ $video->tipo_licencia }}</p>

				<p class="mb-0">Participantes</p>
				<ul class="list-inline bg-light p-2">
					@forelse ($video->competitors as $competitor)
					<li class=""> - {{$competitor->user->name .' '.$competitor->user->last_name}} ({{$competitor->type->name}})</li>
					@empty
					<li class="text-muted">No hay participantes.</li>
					@endforelse
				</ul>

				@if ($tags)
				<p class="mb-0">Etiquetas</p>
				<ul class="list-inline">
					@foreach ($tags as $tag)
					<li class="d-inline-block"><span class="badge badge-primary px-2">{{$tag}}</span></li>
					@endforeach
				</ul>
				@endif
		        <div>
		        	<a href="{{route('videos.edit', $video->id)}}" class="btn btn-warning"><i class="fal fa-edit"></i> Editar</a>
		        	<a href="" class="btn btn-danger"><i class="fal fa-trash-alt"></i></a>
		        </div>
		      </div>
		    </div>
		  </div>
	  	@endforeach
	</div>
@endsection

