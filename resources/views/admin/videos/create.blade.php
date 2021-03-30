@extends('layouts.app', ['title' => 'Crear Videos'])
@section('content')
	
	<a href="grupos" class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i> Lista de Videos</a>
	
	<div class="row">
		<div class="col-md-8">
		    <div class="card card-user">
		      <div class="card-header">
		        <h5 class="card-title">
		        Crear video</h5>
		      </div>
		      <div class="card-body">
		        	<form class="form-group" method="POST" action="{{ route('videos.store') }}" enctype="multipart/form-data">
		          @csrf
		          <input type="hidden" name="status" value="1">
		          <input type="hidden" name="video_types_id" value="1">
		          <input type="hidden" name="tags" value="1">

		          <div class="row">
		            <div class="col-md-8">
		              <div class="form-group">
		                <label><i class="fas fa-user"></i>  Nombre del Video</label>
		                <input name='name' type="text" class="form-control" placeholder="Ingrese Nombre del grupo" value="{{ old('name') }}">

		                @error('name')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>

		            <div class="col-md-4">
		              <div class="form-group">
		                <label><i class="fas fa-briefcase"></i> Especialidad</label>
		                <input name='especialidad' type="text" class="form-control" placeholder="Ingrese especialidad" value="{{ old('especialidad') }}">

		                @error('especialidad')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>

		          </div>


		          <div class="row">
		            <div class="col-md-12">
		              <div class="form-group">
		                <label><i class="fas fa-biohazard"></i> Contenido o Tema</label>
		                <input name='tema' type="text" class="form-control" placeholder="Ingrese tema" value="{{ old('tema') }}">

		                @error('tema')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>
		          </div>


		          <div class="row">
		            <div class="col-md-12">
		              <div class="form-group">
		                <label><i class="fal fa-file-spreadsheet"></i> Reseña del contenido o tema</label>
		                <textarea name="resumen" rows="10" cols="50" type="text" class="form-control" placeholder="Ingrese contenido" value="">{{ old('resumen') }}</textarea>
		                
		                @error('resumen')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>
		          </div>


		          <div class="row">
		            <div class="col-md-4">
		              <div class="form-group">
		                <label><i class="far fa-calendar-alt"></i> Fecha de ejecución</label>
		                <input name='fecha' type="date" class="form-control" placeholder="Ingrese fecha" value="{{ old('fecha') }}" id="fecha_evento">

		                @error('fecha')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>
		            
		            <div class="col-md-4">
		              <div class="form-group">
		                <label><i class="fas fa-map-marker-check"></i> Lugar del evento</label>
		                <input name='lugar' type="text" class="form-control" placeholder="Ingrese Fecha del evento" value="{{ old('lugar') }}">

		                @error('lugar')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>

		            <div class="col-md-4">
		              <div class="form-group">
		                <label><i class="far fa-hourglass-half"></i> Duración</label>
		                <input name='duracion' type="text" class="form-control" placeholder="Ingrese duracion" value="{{ old('duracion') }}">

		                @error('duracion')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>

		          </div>

		          
		          <div class="row">
		            <div class="col-md-12">
		              <div class="form-group">
		                <label><i class="fab fa-youtube"></i> URL del Video</label>
		                <input name='url' type="text" class="form-control" placeholder="Ingrese url" value="{{ old('url') }}">

		                @error('url')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>
		          </div>

		          <div class="row">
		            <div class="col-md-12">
		              <div class="form-group">
		                <label><i class="far fa-key"></i> Palabras Claves - Keys</label>
		                <input name='keys' type="text" class="form-control" placeholder="Ingrese palabras claves separadas por coma(,), por ejemplo, | Doctores, Medicina, Covid..." value="{{ old('keys') }}">

		                @error('keys')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>
		          </div>

		          
		          <div class="row">
		            <div class="update ml-auto mr-auto">
		              <button type="submit" class="btn btn-primary btn-round">Crear Video</button>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>	
	</div>

@endsection

@section('javascript')

	<script type="text/javascript">
		$( function() {
			$( "#fecha_evento" ).datepicker();
		} );
	</script>
	
@endsection

