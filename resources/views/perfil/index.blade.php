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
			<form class="form-group" method="POST" action="{{ route('perfil.update.datos', $user->id) }}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<h4><i class="fal fa-user"></i> Mis datos personales</h4>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inputEmail4">Nombre</label>
						<input type="text" name='name' class="form-control @error('name') is-invalid @enderror" id="name" value="{{$usuario->name}}">
						@error('name')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group col-md-4">
						<label for="inputPassword4">Apellido Paterno</label>
						<input type="text" name='last_name' class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{$usuario->last_name}}">
						@error('last_name')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group col-md-4">
						<label for="inputPassword4">Apellido Materno</label>
						<input type="text" name='mothers_last_name' class="form-control @error('mothers_last_name') is-invalid @enderror" id="mothers_last_name" value="{{$usuario->mothers_last_name}}">
						@error('mothers_last_name')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inputCity">Docuento de identidad</label>
						<input type="text" name='document' class="form-control" id="document" value="{{$usuario->document}}">
					</div>
					<div class="form-group col-md-4">
						<label for="inputCity">Teléfono</label>
						<input type="text" name='telephone' class="form-control" id="telephone" value="{{$usuario->telephone}}">
					</div>
					<div class="form-group col-md-4">
						<label for="inputCity">Celular</label>
						<input type="text" name='celular' class="form-control" id="celular" value="{{$usuario->celular}}">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-8">
						<label for="inputCity">Dirección</label>
						<input type="text" name='address' class="form-control" id="address" value="{{$usuario->address}}">
					</div>
					<div class="form-group col-md-4">
						<label for="inputCity">Urbanización</label>
						<input type="text" name='urbanizacion' class="form-control" id="urbanizacion" value="{{$usuario->urbanizacion}}">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-3">
						<label for="inputCity">País</label>
						<input type="text" name='country' class="form-control" id="country" value="{{$usuario->country}}">
					</div>
					<div class="form-group col-md-3">
						<label for="inputCity">Provincia</label>
						<input type="text" name='provincia' class="form-control" id="provincia" value="{{$usuario->provincia}}">
					</div>
					<div class="form-group col-md-3">
						<label for="inputCity">Ciudad</label>
						<input type="text" name='city' class="form-control" id="city" value="{{$usuario->city}}">
					</div>
					<div class="form-group col-md-3">
						<label for="inputCity">Distrito</label>
						<input type="text" name='distrito' class="form-control" id="distrito" value="{{$usuario->distrito}}">
					</div>
				</div>

				<h4 class="mt-5"><i class="far fa-address-card"></i> Acerca de mi</h4>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inputCity">Universidad que estudie</label>
						<input type="text" name='universidad' class="form-control" id="universidad" value="{{$usuario->universidad}}">
					</div>
					<div class="form-group col-md-4">
						<label for="inputCity">Profesión</label>
						<input type="text" name='profesion' class="form-control" id="provincia" value="{{$usuario->profesion}}">
					</div>
					<div class="form-group col-md-4">
						<label for="inputCity">Lugar de Trabajo actual</label>
						<input type="text" name='lugar_trabajo' class="form-control" id="lugar_trabajo" value="{{$usuario->lugar_trabajo}}">
					</div>
				</div>

				<div class="form-group">
					<label for="exampleFormControlTextarea1">Breve resaña </label>
					<textarea class="form-control" name='resena' id="resena" rows="3">{{$usuario->resena}}</textarea>
				</div>



				<button type="submit" class="btn btn-primary">Actualizar datos</button>
			</form>	
		</div>

		{{--Segunda columna--}}
		<div class="col-4">
			<h4 class="text-danger"><i class="fal fa-key"></i> Seguridad y privacidad</h4>
			<form class="form-group" method="POST" action="{{ route('perfil.update.user', $user->id) }}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputEmail4">Usuario</label>
						<input type="email" name='email' class="form-control @error('email') is-invalid @enderror" id="inputEmail4" value="{{$user->email}}" disabled>
						@error('email')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputPassword4">Password</label>
						<input type="password" name='password' class="form-control @error('password') is-invalid @enderror" id="inputPassword4">
						@error('password')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group col-md-6">
						<label for="inputPassword4">Repetir Password</label>
						<input type="password" class="form-control" name="password_confirmation" id="inputPassword4">
					</div>
				</div>
				<button type="submit" class="btn btn-danger">Actualizar contraseña</button>
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
							<a href="https://www.desarrollo.aspefam.org.pe/course/view.php?id={{$miCurso->course_id}}">{{$miCurso->shortname}}</a>
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
