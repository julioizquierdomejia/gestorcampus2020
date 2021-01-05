@extends('layouts.app', ['title' => 'Activar Cursos'])

@section('content')

	<div class="row">
		<div class="col-md-4">
			<div class="card card-user">
				<div class="image">
					<img src="/../assets/img/damir-bosnjak.jpg" alt="...">
				</div>
				<div class="card-body">
					<h5 class="title text-success">{{$cursos_moodle->fullname}}</h5>
					
					<ul class="list-group list-group-flush">
						@foreach($secciones as $seccion)
								@if($seccion->name == NULL)
								@else
									<li class="list-group-item border">{{ $seccion->name }}</li>
								@endif
						@endforeach
					</ul>
					<p class="description text-center">
						"Donde quiera que se ama el arte de la medicina
						<br>
						se ama también a la humanidad. <br>
						(Platón)."
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-user">
		      <div class="card-header">
		        <h5 class="card-title">
		        Información Complementaria</h5>
		      </div>
		      <div class="card-body">
		      	<form class="form-group" method="POST" action="/cursos" enctype="multipart/form-data">
		          @csrf
		          <input name='course_moodle_id' type="hidden" class="form-control" placeholder="" value="{{$course}}">
		          <input name='categoria' type="hidden" class="form-control" placeholder="" value="{{$cursos_moodle->category}}">
		          <input name='fullname' type="hidden" class="form-control" placeholder="" value="{{$cursos_moodle->fullname}}">
		          <input name='shortname' type="hidden" class="form-control" placeholder="" value="{{$cursos_moodle->shortname}}">

		        <div class="row">
		        	<div class="col">
		        		<div class="custom-control custom-switch">
						  <input type="checkbox" class="custom-control-input" id="customSwitch1" checked style="padding:2px; width: 60px;">
						  <label class="custom-control-label" for="customSwitch1">Activar</label>
						</div>
		        	</div>		
		        </div>

		        <div class="row">
		        	<div class="col">
		        		<div class="custom-control custom-switch">
						  <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
						  <label class="custom-control-label" for="customSwitch1">Activar</label>
						</div>
		        	</div>		
		        </div>


				<div class="row">
		          	<div class="col">
		          		<div class="form-check">
						  <input class="form-check-input" type="radio" name="status" id="activo" value="1" checked>
						  <label class="form-check-label" for="activo">
						    Activar Curso
						  </label>
						</div>
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="status" id="inactivo" value="2">
						  <label class="form-check-label" for="inactivo">
						    Desactivar Curso
						  </label>
						</div>
		          	</div>

		          </div>

		          <div class="row">
		            <div class="col-md-7">
		              <div class="form-group">
		                <label>Instructor</label>
		                <input name='instructor' type="text" class="form-control" placeholder="Ingrese el nombre del instructor" value="">
		              </div>
		            </div>
		            <div class="col-md-5">
		              <div class="form-group">
		                <label>Precio</label>
		                <input name='price' type="text" class="form-control" placeholder="Ingrese Precio" value="">
		              </div>
		            </div>
		          </div>
		          <div class="row">
		          	<div class="col">
		          		<div class="form-group">
    						<label for="exampleFormControlTextarea1">Introducción</label>
    						<textarea class="form-control" id="introduccion" name="introduccion" rows="3"></textarea>
  						</div>
		          	</div>
		          </div>
		          <div class="row">
		          	<div class="col">
		          		<div class="form-group">
    						<label for="exampleFormControlTextarea1">Descripción</label>
    						<textarea class="form-control" id="description" name="description" rows="3"></textarea>
  						</div>
		          	</div>
		          </div>
		          <div class="row">
		          	<div class="col">
		          		<div class="form-group">
    						<label for="exampleFormControlTextarea1">Información Adicional</label>
    						<textarea class="form-control" id="Informacion_adicional" name="Informacion_adicional" rows="3"></textarea>
  						</div>
		          	</div>
		          </div>
		          <div class="row">
		          	<div class="col">
		          		<div class="form-group">
    						<label for="exampleFormControlTextarea1">Novedades</label>
    						<textarea class="form-control" id="novedades" name="novedades" rows="3"></textarea>
  						</div>
		          	</div>
		          </div>
		          
		          <div class="row">
		            <div class="update ml-auto mr-auto">
		              <button type="submit" class="btn btn-primary btn-round">Grabar</button>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>
		</div>

	</div>


@endsection

  
    
  

