@extends('layouts.frontend', ['title' => 'Mis certificados'])

@section('content')

hola soy el certificado

<div class="container mt-5">
	<div class="row">
		<div class="col">
			<img src="{{ asset('/certificados/base.png') }}" class="img-fluid" alt="...">
		</div>
	</div>

</div>



@endsection
