@extends('layouts.frontend', ['title' => 'Mis certificados'])

@section('content')



<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col">
			<div class="certificado">
				<img src="{{ asset('/certificados/') }}/{{$img->basename}}" class="img-fluid" alt="...">	
			</div>
			
		</div>
	</div>

</div>

@endsection
