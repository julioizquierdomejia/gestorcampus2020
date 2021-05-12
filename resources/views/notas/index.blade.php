@extends('layouts.frontend', ['title' => 'Mis notas'])

@section('content')

<img src="{{ asset('/images/header_perfil.png') }}" class="card-img-top" alt="Imagen del curso">

<div class="row components_content p-5">
	<div class="row">
		<div class="col">
			<h2>Nombre : {{ $usuario->name }}</h2>
			<h3>{{$curso->fullname}}</h3>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col">
			<h5>Mi progreso</h5>
			<div class="progress">
			  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$percent}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<p>[ {{$cant_notas}} evaluaciones de {{$cant_notas_existente}} / {{$percent}}% ]</p>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-4">
			<h4>Mis notas </h4>

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
				      <td>{{ round($nota->grade, 2) }} </td>
				    </tr>
				@endforeach
			  </tbody>
			</table>
		</div>
		<div class="col-4">
			@if($statusCurso == true)
				<h4>Nota Final </h4>
				<p>{{$promedio}}</p>
			@else
				false
			@endif
		</div>
	</div>

	
</div>


@endsection
