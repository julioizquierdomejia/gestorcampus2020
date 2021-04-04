@extends('layouts.frontend', ['title' => 'Campus Aspefam'])

@section('content')
	<!-- Componente Slider -->
	@include('components.slider')
	
	@include('components.coursesTabs')
	@include('components.videosList', ['videos' => $videos])
	@include('components.about')
	@include('components.tips')
@endsection
