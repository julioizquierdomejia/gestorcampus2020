@extends('layouts.interna', ['title' => 'Mi perfil'])

@section('content')

	<div class="row">
		<div class="col p-5">
			Bienvenido : {{ $usuario->name }}
		</div>
	</div>

@endsection
