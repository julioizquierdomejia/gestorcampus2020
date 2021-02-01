@extends('layouts.app', ['title' => 'Tipo de Videos'])
@section('content')
	
	<a href="{{ route('videostipos.create')}}" class="btn btn-primary"><i class="fal fa-layer-group"></i> Crear Nueva Categoría</a>
	<div class="row row-cols-1 row-cols-md-4 g-4 mt-5">
		@foreach($videoTipos as $key => $tipo)
		  <div class="col">
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title"><i class="fal fa-file-certificate"></i> {{ $tipo->name }}</h5>
		        <p class="card-text">{{ $tipo->description }}</p>
		        <div>
		        	<a href="{{route('videostipos.edit', $tipo->id)}}" class="btn btn-warning"><i class="fal fa-edit"></i> Editar</a>
		        	<a href="" class="btn btn-danger"><i class="fal fa-trash-alt"></i></a>
		        </div>
		      </div>
		    </div>
		  </div>
	  	@endforeach
	</div>
@endsection

