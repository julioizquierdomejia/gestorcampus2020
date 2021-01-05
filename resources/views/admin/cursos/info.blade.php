@extends('layouts.app', ['title' => 'info Cursos'])

@section('content')

	<div class="row">
		<div class="col-md-4">
			<div class="card card-user">
				<div class="image">
					<img src="../assets/img/damir-bosnjak.jpg" alt="...">
				</div>
				<div class="card-body">
					<h5 class="title text-success">{{$cursos_moodle->fullname}}</h5>
					
					<ul class="list-group list-group-flush">
						@foreach($secciones as $seccion)
								@if($seccion->name == NULL)
								@else
									<li class="list-group-item border">{{ $seccion->name }}</li>
								@endif
						@endforeach
					</ul>
					<h3>

						@if($cursos->isEmpty())
							<a href=" {{ route('curso.active', $cursos_moodle->id) }} " class="btn btn-secondary">Activar</a>
						@else

							@if($statusCurso == 'ACTIVO')
								<a href=" {{ route('curso.active', $cursos_moodle->id) }} " class="btn btn-warning">Editar</a>
							@endif

							@if($statusCurso == 'MOODLE')
								<a href=" {{ route('curso.active', $cursos_moodle->id) }} " class="btn btn-secondary">Activar</a>
							@endif
							
						@endif
					</h3>
					<p class="description text-center">
						"Donde quiera que se ama el arte de la medicina
						<br>
						se ama también a la humanidad. <br>
						(Platón)."
					</p>
				</div>
			</div>
		</div>
	</div>


@endsection

  
    
  

