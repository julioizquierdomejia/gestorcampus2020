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
		            <div class="col-md-4">
		              <div class="form-group">
		                <label>Nombre del Video</label>
		                <input name='name' type="text" class="form-control" placeholder="Ingrese Nombre del grupo" value="{{ old('name') }}">

		                @error('name')
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
		                <label>Especialidad</label>
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
		            <div class="col-md-4">
		              <div class="form-group">
		                <label>Tema</label>
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
		            <div class="col-md-4">
		              <div class="form-group">
		                <label>Contenido</label>
		                <input name='contenido' type="text" class="form-control" placeholder="Ingrese contenido" value="{{ old('contenido') }}">

		                @error('contenido')
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
		                <label>Fecha</label>
		                <input name='fecha' type="text" class="form-control" placeholder="Ingrese fecha" value="{{ old('fecha') }}">

		                @error('fecha')
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
		                <label>Duración</label>
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
		            <div class="col-md-4">
		              <div class="form-group">
		                <label>URL del Video</label>
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

@endsection

