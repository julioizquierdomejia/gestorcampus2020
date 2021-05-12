@extends('layouts.frontend', ['title' => 'Mis notas'])

@section('content')

<img src="{{ asset('/images/header_perfil.png') }}" class="card-img-top" alt="Imagen del curso">

<div class="row components_content p-5">
	<div class="row">
		<div class="col-4">
			<h2>Mis notas </h2>

			<table class="table table-striped">
			  <thead>
			    <tr>
			    	<th>Notas</th>
			    	<th>la nota</th>
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
