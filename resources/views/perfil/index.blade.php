@extends('layouts.frontend', ['title' => 'Mi perfil'])

@section('content')

	<img src="{{ asset('/images/header_perfil.png') }}" class="card-img-top" alt="Imagen del curso">
	
	{{--
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
	--}}

	<div class="row components_content p-5">
		{{-- Primera Columna --}}
		<div class="col-8">
			<h4><i class="fal fa-user"></i> Mis datos personales</h4>
			<form>
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="inputEmail4">Email</label>
			      <input type="email" class="form-control" id="inputEmail4">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="inputPassword4">Password</label>
			      <input type="password" class="form-control" id="inputPassword4">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputAddress">Address</label>
			    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
			  </div>
			  <div class="form-group">
			    <label for="inputAddress2">Address 2</label>
			    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="inputCity">City</label>
			      <input type="text" class="form-control" id="inputCity">
			    </div>
			    <div class="form-group col-md-4">
			      <label for="inputState">State</label>
			      <select id="inputState" class="form-control">
			        <option selected>Choose...</option>
			        <option>...</option>
			      </select>
			    </div>
			    <div class="form-group col-md-2">
			      <label for="inputZip">Zip</label>
			      <input type="text" class="form-control" id="inputZip">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="form-check">
			      <input class="form-check-input" type="checkbox" id="gridCheck">
			      <label class="form-check-label" for="gridCheck">
			        Check me out
			      </label>
			    </div>
			  </div>
			  <button type="submit" class="btn btn-primary">Sign in</button>
			</form>	
		</div>

		{{--Segunda columna--}}
		<div class="col-4">
			<h4 class="text-danger"><i class="fal fa-key"></i> Seguridad y privacidad</h4>
			<form>
			  <div class="form-row">
			    <div class="form-group col-md-12">
			      <label for="inputEmail4">Usuario</label>
			      <input type="email" class="form-control" id="inputEmail4">
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="inputPassword4">Password</label>
			      <input type="password" class="form-control" id="inputPassword4">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="inputPassword4">Repetir Password</label>
			      <input type="password" class="form-control" id="inputPassword4">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputAddress">Address</label>
			    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
			  </div>
			  <div class="form-group">
			    <label for="inputAddress2">Address 2</label>
			    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="inputCity">City</label>
			      <input type="text" class="form-control" id="inputCity">
			    </div>
			    <div class="form-group col-md-4">
			      <label for="inputState">State</label>
			      <select id="inputState" class="form-control">
			        <option selected>Choose...</option>
			        <option>...</option>
			      </select>
			    </div>
			    <div class="form-group col-md-2">
			      <label for="inputZip">Zip</label>
			      <input type="text" class="form-control" id="inputZip">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="form-check">
			      <input class="form-check-input" type="checkbox" id="gridCheck">
			      <label class="form-check-label" for="gridCheck">
			        Check me out
			      </label>
			    </div>
			  </div>
			  <button type="submit" class="btn btn-primary">Sign in</button>
			</form>	

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
