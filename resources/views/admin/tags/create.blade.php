@extends('layouts.app', ['title' => 'Crear Grupo'])
@section('content')
	
	<a href="grupos" class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i> Lista de Etiquetas</a>
	
	<div class="row">
		<div class="col-md-8">
		    <div class="card card-user">
		      <div class="card-header">
		        <h5 class="card-title">
		        Crear Etiqueta</h5>
		      </div>
		      <div class="card-body">
		        	<form class="form-group" method="POST" action="{{ route('tags.store') }}" enctype="multipart/form-data">
		          @csrf
		          <input type="hidden" name="status" value="1">
		          <div class="row">
		            <div class="col-md-4">
		              <div class="form-group">
		                <label>Nombre de la Etiqueta</label>
		                <input name='name' type="text" class="form-control" placeholder="Ingrese Nombre del grupo" value="">

		                @error('name')
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
		                <label>Descripcion</label>
		                <textarea name='description' class="form-control" id="description" rows="3"></textarea>

		                @error('description')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>
		          </div>
		          
		          <div class="row">
		            <div class="update ml-auto mr-auto">
		              <button type="submit" class="btn btn-primary btn-round">Crear Etiqueta</button>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>	
	</div>



@endsection

