@extends('layouts.frontend', ['title' => 'Mis notas'])

@section('content')

<img src="{{ asset('/images/header_perfil.png') }}" class="card-img-top" alt="Imagen del curso">


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
			      
			      
			    </tr>
			@endforeach
		    
		    
		  </tbody>
		</table>
	</div>
</div>


@endsection
