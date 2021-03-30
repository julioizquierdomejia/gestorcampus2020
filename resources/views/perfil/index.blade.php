@extends('layouts.frontend', ['title' => 'Mi perfil'])

@section('content')

	<img src="{{ asset('/images/header_perfil.png') }}" class="card-img-top" alt="Imagen del curso">
	
	<div class="row components_content p-5">
		<div class="col">
			<h2><i class="fas fa-user-tag text-success"></i> Mi área personal</h2>
			<div class="alert alert-primary mt-4" role="alert">
			  <p><span style="font-weight: bold;">Nombre :</span> {{ $usuario->name }}</p>
			  <p>Apellidos : {{ $usuario->last_name }} {{ $usuario->mothers_last_name }}</p>
			  <p>Dirección : {{ $usuario->address }}</p>
			  <p>- {{ $usuario->city }}</p>
			  <p>- {{ $usuario->provincia }}</p>
			  <p>- {{ $usuario->distrito }}</p>
			  
			</div>
		</div>
	</div>

	<div class="row components_content p-5">
		<div class="col">
			<h3><i class="fal fa-file-certificate"></i> Mis Cursos</h3>
			
			<div class="row row-cols-1 row-cols-md-4 mt-5">

				@forelse ($misCursos as $key => $miCurso)
					<div class="col mb-4">
				    <div class="card">
				      <img src="{{ asset('/images/images_cursos/'.$miCurso->img) }}" class="card-img-top" alt="...">
				      <div class="card-body">
				        <h5 class="card-title">{{$miCurso->shortname}}</h5>
				        
				      </div>
				    </div>
				  </div>
				@empty
					No hay datos
				@endforelse

			</div>

		</div>
	</div>

	<div class="row components_content p-5">
		<div class="col">
			<h3><i class="fas fa-user-tag text-success"></i> Mis Certificados</h3>
			
			<div class="row mt-5">
			  
			  <div class="col-sm-4">
			    <div class="card">
			      <div class="card-body">
			        <h5 class="card-title"><b>Curso de Salud Mental</b></h5>
			        <h6 class="card-subtitle mb-2 text-primary">CERTIFICADO</h6>
			        <p class="card-text">Se certifica que {{$usuario->name}} aprobó el curso de Salud Mental</p>
			        <a href="#" class="btn btn-primary">Ver certificado</a>
			      </div>
			    </div>
			  </div>

			  <div class="col-sm-4">
			    <div class="card">
			      <div class="card-body">
			        <h5 class="card-title"><b>Curso de Primero Auxilios</b></h5>
			        <h6 class="card-subtitle mb-2 text-primary">CERTIFICADO</h6>
			        <p class="card-text">Se certifica que {{$usuario->name}} aprobó el curso de Primeros Auxilios</p>
			        <a href="#" class="btn btn-primary">Ver certificado</a>
			      </div>
			    </div>
			  </div>

			</div>

		</div>
	</div>


@endsection
