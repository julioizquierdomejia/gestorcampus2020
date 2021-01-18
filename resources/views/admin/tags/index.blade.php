@extends('layouts.app', ['title' => 'Tags'])
@section('content')
	
	<a href="{{ route('tags.create')}}" class="btn btn-primary"><i class="fal fa-layer-group"></i> Crear Nueva Etiqueta</a>
	<div class="row row-cols-1 row-cols-md-4 g-4 mt-5">
		@foreach($tags as $key => $tag)
		  <div class="col">
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title"><i class="fas fa-tag" style="color: {{ $tag->color  }}"></i> - {{ $tag->name }}</h5>
		        <p class="card-text">{{ $tag->description }}</p>
		        <span class="badge badge-pill p-2 px-3" style="background-color: {{ $tag->color  }}">{{$tag->name}}</span>
		        <div>
		        	<a href="{{route('tags.edit', $tag->id)}}" class="btn btn-warning"><i class="fal fa-edit"></i> Editar</a>
		        	<a href="" class="btn btn-danger"><i class="fal fa-trash-alt"></i></a>
		        </div>
		      </div>
		    </div>
		  </div>
	  	@endforeach
	</div>
@endsection

