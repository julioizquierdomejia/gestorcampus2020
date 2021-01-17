@extends('layouts.app', ['title' => 'Grupos para Cursos'])
@section('content')
	
	<a href="{{ route('grupos.create')}}" class="btn btn-primary"><i class="fal fa-layer-group"></i> Crear nuevo Grupo</a>
	<div class="row row-cols-1 row-cols-md-4 g-4 mt-5">
		@foreach($grupos as $key => $grupo)
		  <div class="col">
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title">{{ $grupo->name }} {{$grupo->id}}</h5>
		        <p class="card-text">{{ $grupo->description }}</p>
		        <div>
		        	<a href="{{route('grupos.edit', $grupo->id)}}" class="btn btn-warning"><i class="fal fa-edit"></i> Editar</a>
		        	<a href="" class="btn btn-danger"><i class="fal fa-trash-alt"></i></a>
		        </div>
		      </div>
		    </div>
		  </div>
	  	@endforeach
	</div>
@endsection

