@extends('layouts.app')

@section('content')
<?php 
$url = "https://zoom.us/oauth/authorize?response_type=code&client_id=".env('CLIENT_ID')."&redirect_uri=".env('REDIRECT_URI');
?>
  
<a href="<?php echo $url; ?>">Login with Zoom</a>
<form class="frm-zoom" action="/create-meeting">
	<label>Tema</label>
	<input class="form-control" type="text" name="topic" value="Let's learn Laravel">
	<!-- <label>Tipo</label> -->
	<input class="form-control" type="hidden" name="type" value="2">
	<label>Hora inicio</label>
	<input class="form-control" type="text" name="start_time" value="2020-05-05T20:30:00">
	<label>Duración</label>
	<input class="form-control" type="text" name="duration" value="30">
	<label>Contraseña</label>
	<input class="form-control" type="text" name="password" value="123456">

	<button class="btn" type="submit">Enviar</button>
</form>
@endsection