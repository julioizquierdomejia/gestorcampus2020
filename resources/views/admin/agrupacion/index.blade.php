@extends('layouts.app', ['title' => 'grupos'])
@section('content')
	
	<a href="{{ route('agrupacion.create')}}" class="btn btn-primary"><i class="fal fa-layer-group"></i> Crear Grupo de curso</a>
	<div class="row row-cols-1 row-cols-md-4 g-4 mt-5">
		@foreach($agrupacion as $agrupo)
		  <div class="col">
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title">{{ $agrupo->name }}</h5>
		        <p class="card-text">{{ $agrupo->description }}</p>
		        <div>
		        	<a href="{{route('agrupacion.edit', $agrupo->id)}}" class="btn btn-warning"><i class="fal fa-edit"></i> Editar - {{ $agrupo->id }}</a>
		        	<a href="" class="btn btn-danger"><i class="fal fa-trash-alt"></i></a>
		        </div>
		      </div>
		    </div>
		  </div>
	  	@endforeach
	</div>
@endsection

