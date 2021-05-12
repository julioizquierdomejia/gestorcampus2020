@extends('layouts.frontend', ['title' => 'Mis notas'])

@section('content')

<img src="{{ asset('/images/header_perfil.png') }}" class="card-img-top" alt="Imagen del curso">

<div class="row components_content p-5">
	<div class="row">
		<div class="col">
			<h5>Mi progreso</h5>
			<p>[ {{$cant_notas}} evaluaciones de $cant_notas_existente / {{$percent}}% ]</p>
			<div class="progress">
			  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$percent}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-4">
			<h1>{{$curso->fullname}}</h1>
			<h2>Mis notas </h2>

			<table class="table table-striped">
			  <thead>
			    <tr>
			    	<th>Evaluación</th>
			    	<th>Nota</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($notas as $nota)
					<tr>
				      <td>{{ $nota->name}} </td>
				      <td>{{ $nota->grade}} </td>
				    </tr>
				@endforeach
			  </tbody>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col">
			@if($statusCurso == true)
				true
			@else
				false
			@endif
		</div>
	</div>
</div>


@endsection
