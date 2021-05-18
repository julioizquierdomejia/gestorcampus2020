@extends('layouts.frontend', ['title' => 'Mis certificados'])

@section('content')

{{$certificado}}

<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col">
			<div class="certificado">
				{{--<img src="{{ asset('/certificados/') }}/{{$img->basename}}" class="img-fluid" alt="...">	--}}
				<img src="{{ $certificado }}">
			</div>
			
		</div>
	</div>

</div>

@endsection
