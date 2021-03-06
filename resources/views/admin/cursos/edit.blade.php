@extends('layouts.app', ['title' => 'Activar Cursos'])

@section('content')
	

	<div class="row">
		<div class="col-md-4">
			<div class="card card-user">
				<div class="image">
					<img src=" {{ asset('/../assets/img/damir-bosnjak.jpg') }} " alt="...">
				</div>
				<div class="card-body">
					<h5 class="title text-success">El titulo </h5>
					
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

		{{-- Inicia el formulario --}}

		<div class="col-md-8">
			<div class="card card-user">
		      <div class="card-header">
		        <h5 class="card-title">
		        Información Complementaria</h5>
		      </div>
		      <div class="card-body">
		      	<form class="form-group" method="POST" action=" {{ route('cursos.update', 1) }} " enctype="multipart/form-data">
		          @csrf
		          @method('PUT')

		          <input name='course_id' type="hidden" class="form-control" placeholder="" value="{{ $curso->id }}" id="">
		          
		          {{-- Campos ocultos de apoyo para los grpos --}}
		          <input name='course_group_id' type="hidden" class="form-control" placeholder="" value="{{ $grupo_curso->id }}" id="course_group_id">
		          <input name='course_group' type="hidden" class="form-control" placeholder="" value="{{ $grupo_curso->name }}" id="course_group">

		          {{-- Campos ocultos de apoyo para el tipo de curso --}}
		          <input name='type' type="hidden" class="form-control" placeholder="" value="{{ $curso->type }}" id="type">
		          <input name='type_name' type="hidden" class="form-control" placeholder="" value=" {{$nombre_type}}" id="type_name">
			        
			        <div class="row">
			        	<div class="col">
			        		<div class="dropdown">
							  <button class="btn btn-secondary dropdown-toggle" type="button" id="opc-active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Seleccione un Grupo
							  </button>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							  	@foreach($grupos as $key => $grupo)
							  		<a class="dropdown-item dropdown-item-grupo" href="#" data-id={{$grupo->id}}>{{$grupo->name}}</a>
							  	@endforeach
							  </div>
							  @error('course_group_id')
			                    <span class="invalid-feedback d-block" role="alert">
			                        <strong>{{ $message }}</strong>
			                    </span>
			                @enderror
							</div>
			        	</div>		
			        </div>

			        <div class="row">
			        	<div class="col">
			        		<div class="dropdown">
							  <button class="btn btn-secondary dropdown-toggle" type="button" id="opc-type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Seleccione tipo de Curso
							  </button>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							  	<a class="dropdown-item dropdown-item-type" href="#" data-id='1'>PostPago</a>
							  	<a class="dropdown-item dropdown-item-type" href="#" data-id='2'>Prepago</a>
							  </div>
							  @error('type')
			                    <span class="invalid-feedback d-block" role="alert">
			                        <strong>{{ $message }}</strong>
			                    </span>
			                @enderror
							</div>
			        	</div>		
			        </div>

			        <div class="row d-none">
			        	<div class="col">
			        		<div class="form-group">
				                <label>Arreglo de tags</label>
				                <input name='tags' type="text" class="form-control" value="" id='tags_array'>
				              </div>
			        	</div>
			        </div>
			        <div class="row mt-3">
			        	<p>Seleccione etiquetas para este curso</p>
			        	<div class="col" id="selectores">

			        		{{--

			        		@foreach($myTags as $key => $myTag)
			        			<a href="#" id="{{$myTag->id}}" class="opc-tag" style="opacity: 1">
			        				<span class="badge badge-pill p-2 px-3" style="background-color: {{$myTag->color}}">{{$myTag->name}}</span>
			        			</a>
			        		@endforeach

			        		@foreach($tags as $key => $tag)
			        			<a href="#" id="{{$tag->id}}" class="opc-tag" style="opacity: 0.32">
			        				<span class="badge badge-pill p-2 px-3" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
			        			</a>
			        		@endforeach

			        		--}}

			        	</div>
			        </div>
			        
		          <div class="row mt-3">
		            <div class="col-md-7">
		              <div class="form-group">
		                <label>Instructor</label>
		                <input name='instructor' type="text" class="form-control" placeholder="Ingrese el nombre del instructor" value="{{$curso->instructor}}">

		                @error('instructor')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror


		              </div>
		            </div>
		            <div class="col-md-5">
		              <div class="form-group">
		                <label>Precio</label>
		                <input name='price' type="text" class="form-control" placeholder="Ingrese Precio" value="{{$curso->price}}">
		              </div>
		            </div>
		          </div>
		          <div class="row">
		          	<div class="col">
		          		<div class="form-group">
    						<label for="exampleFormControlTextarea1">Introducción</label>
    						<textarea class="form-control" id="introduccion" name="introduccion" rows="3">{{$curso->introduccion}}</textarea>

    						@error('introduccion')
			                    <span class="invalid-feedback d-block" role="alert">
			                        <strong>{{ $message }}</strong>
			                    </span>
			                @enderror
  						</div>
		          	</div>
		          </div>
		          <div class="row">
		          	<div class="col">
		          		<div class="form-group">
    						<label for="exampleFormControlTextarea1">Descripción</label>
    						<textarea class="form-control" id="description" name="description" rows="3">{{$curso->description}}</textarea>
  						</div>
		          	</div>
		          </div>
		          <div class="row">
		          	<div class="col">
		          		<div class="form-group">
    						<label for="exampleFormControlTextarea1">Información Adicional</label>
    						<textarea class="form-control" id="Informacion_adicional" name="Informacion_adicional" rows="3">{{$curso->informacion_adicional}}</textarea>
  						</div>
		          	</div>
		          </div>
		          <div class="row">
		          	<div class="col">
		          		<div class="form-group">
    						<label for="exampleFormControlTextarea1">Novedades</label>
    						<textarea class="form-control" id="novedades" name="novedades" rows="3">{{$curso->novedades}}</textarea>
  						</div>
		          	</div>
		          </div>
		          
		          <div class="row">
		            <div class="update ml-auto mr-auto">
		              <button type="submit" class="btn btn-primary btn-round">Actualizar Curso</button>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>
		</div>

	</div>


@endsection

@section('javascript')

	<script type="text/javascript">

		//verificamos si antes de la validacion se selecciono algua opcion con mi input de apoyo
		if($('#course_group').val() == ''){
			$('#opc-active').text('Seleccione un Grupo');
		}else{
			$('#opc-active').text($('#course_group').val());
		}

		if($('#type').val() == ''){
			$('#opc-type').text('Seleccione un tipo de curso');
		}else{
			$('#opc-type').text($('#type_name').val());
		}
		
		$('.dropdown-item-grupo').click(function(){

			$('#opc-active').text($(this).text());
			$('#course_group_id').val($(this).data('id'));
			$('#course_group').val($(this).text());
			//alert($(this).text())
		})

		$('.dropdown-item-type').click(function(){

			$('#opc-type').text($(this).text());
			$('#type').val($(this).data('id'));	
			$('#type_name').val($(this).text());
		})

		var tags = [];


		<?php foreach ($tags as $key => $tag): ?>
			$('#selectores').append('<a href="#" id="{{$tag->id}}" class="opc-tag" style="opacity: .32"><span class="badge badge-pill p-2 px-3" style="background-color: {{$tag->color}}">{{$tag->name}}</span></a>')
		<?php endforeach ?>


		<?php foreach ($myTags as $key => $myTag): ?>
			tags.push('{{$myTag->id}}');
			//$(#'{{$myTag->id}}').css('opacity', 1);
			
		<?php endforeach ?>


		$("#tags_array").val(tags);

		var existe = $.inArray($(this).attr('id'), tags);

		$('.opc-tag').click(function(){
			
			existe = $.inArray($(this).attr('id'), tags);

			if(existe == -1){
				$(this).css('opacity', 1); //cambiamos el CSS opacity
				tags.push($(this).attr('id'));
				$("#tags_array").val(tags);
			}else{
				$(this).css('opacity', .32); //cambiamos el CSS opacity
				var obj = $(this).attr('id');
				
				function removeItemFromArr ( arr, item ) {
				    var i = arr.indexOf( item );
				 
				    if ( i !== -1 ) {
				        arr.splice( i, 1 );
				    }
				}

				removeItemFromArr(tags, obj);
				$("#tags_array").val(tags);

			}



		})

	</script>
	
@endsection


  
    
  

