@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col">
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
						@foreach($cursos_moodle as $curso_moodle)
							@if($curso_moodle->category == $categoria->id)
								<tr>
							      <th scope="row">{{ $curso_moodle->id }}</th>
							      <td>{{ $curso_moodle->shortname }}</td>
							      <td>
							      	@if($status == 0) <!-- Base de datos cursos vacia -->
							      		<span class="badge badge-pill badge-warning">Solo Moodle</span>
							      	@else <!-- Base de datos con información -->
							      		
							      	@endif

							      	<!-----------
							      	@foreach($cursos as $curso)
						      			@if($curso->course_moodle_id == $curso_moodle->id)
						      				<span class="badge badge-pill badge-success">Disponible</span>
						      				@continue
						      			@endif
						      		@endforeach
						      		----->
							      </td>
							      <td>
							      	<a href="/cursos/{{$curso_moodle->id}}" title="show">
			                            <i class="fas fa-eye text-success  fa-lg"></i>
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

