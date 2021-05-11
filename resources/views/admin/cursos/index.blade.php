@extends('layouts.app', ['title' => 'Cursos'])

@section('content')
	
	@if(session()->has('success'))
	    <div class="alert alert-warning text-black">
	        {{ session()->get('success') }}
	    </div>
	@endif

	<div class="row">
		<div class="col">
		<h3>Activar Cursos moodle en la plataforma</h3>

			@foreach($categorias as $categoria)
				<h4>{{$categoria->name}}</h4>
				<table class="table table-hover">
				<thead class="thead-dark">
				    <tr>
				      <th scope="col">id</th>
				      <th scope="col">Curso</th>
				      <th scope="col">Disponible</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
					@foreach($cursos_iterados as $key => $curso)
						@if($categoria->id == $curso[3])

							@if($curso[2] == 'ACTIVO')
								<tr class="bg-success">
							@else
								<tr>
							@endif

							
								<th scope="row">{{$curso[0]}}</th>
								<td>{{$curso[1]}}</td>
								<td>{{$curso[2]}}</td>
								<td>
									<a href="{{ route('curso.show', $curso[0] ) }}" title="show">
										@if($curso[2] == 'ACTIVO')
											<i class="fas fa-eye text-white  fa-lg"></i>
										@else
											<i class="fas fa-eye text-success  fa-lg"></i>
										@endif
			                        </a>
								</td>
							</tr>
						@endif
					@endforeach
					</tbody>
				</table>
			@endforeach
		</div>
	</div>

@endsection

