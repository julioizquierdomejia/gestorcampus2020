@extends('layouts.frontend', ['title' => 'Mis certificados'])

@section('content')


<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col">
			<div class="certificado">
				<img src="{{ asset('/certificados/base.png') }}" class="img-fluid" alt="...">	
				<div class="nombre" style="position: absolute; top: 100px; left: 400px;">
					<p>Julio Izquierdo Mejia</p>
				</div>
			</div>
			
		</div>
	</div>

</div>



@endsection
