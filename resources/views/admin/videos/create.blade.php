@extends('layouts.app', ['title' => 'Crear Videos'])
@section('content')
	<style type="text/css">
		.competitor-row:nth-child(odd) {
			background-color: #f7f7f7;
		}
		.competitor-row:nth-child(even) {
			background-color: #f1f1f1;
		}
		@media (max-width: 767px) {
			.btnRemoveRow {
				position: absolute;
				right: 0;
				top: 0;
			}
			.btnRemoveRow .fa {
				font-size: 16px;
			}
		}
	</style>
	<a href="/videos" class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i> Lista de Videos</a>
	
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

		            <div class="col-md-6">
		              <div class="form-group">
		                <label for="video_types"><i class="fas fa-briefcase"></i> Tipo de actividad</label>
		                <select class="form-control" name="video_types_id" id="video_types">
		                	<option value="">Seleccionar</option>
		                	@foreach ($video_types as $type)
		                		<option value="{{$type->id}}">{{$type->description}}</option>
		                	@endforeach
		                </select>
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
		                <textarea name="resumen" rows="10" cols="50" type="text" class="form-control" placeholder="Ingrese reseña" value="">{{ old('resumen') }}</textarea>
		                
		                @error('resumen')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
		              </div>
		            </div>
		            <div class="col-md-12">
		              <div class="form-group">
		                <label><i class="fal fa-file-spreadsheet"></i> Contenido o tema</label>
		                <textarea name="contenido" rows="10" cols="50" type="text" class="form-control" placeholder="Ingrese contenido" value="">{{ old('contenido') }}</textarea>
		                
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
		          	<div class="col-md-4">
		              <div class="form-group">
		                <label><i class="fas fa-map-marker-check"></i> Tipo de licencia</label>
		                <input name='tipo_licencia' type="text" class="form-control" placeholder="Tipo de licencia" value="{{ old('tipo_licencia') }}">

		                @error('tipo_licencia')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror

		              </div>
		            </div>
		            <div class="col-md-12">
		              <div class="form-group">
		                <label><i class="far fa-key"></i> Palabras Claves - Keys</label>
		                <input name='tags' type="text" class="form-control" placeholder="Ingrese palabras claves separadas por coma(,), por ejemplo, | Doctores, Medicina, Covid..." value="{{ old('tags') }}">
		                @error('tags')
		                    <span class="invalid-feedback d-block" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
		              </div>
		            </div>

		            <div class="col-12">
		            	<div class="d-flex align-items-center justify-content-between my-2">
		            		<h4 class="my-0">Participantes</h4>
		            		<button class="btn btn-primary my-0 btnAddRow" type="button">Agregar <i class="fa fa-plus-circle"></i></button>
		            	</div>
		            	<div class="competitor-row-list">
		            	<div class="row competitor-row pt-2 pb-3">
		            		<div class="col-1 competitor-number align-self-center">1</div>
			            	<div class="col-5 col-md-5">
				                <label class="lblCUser mb-0" for="competitorUser"><i class="far fa-user"></i> Usuario</label>
				                <select name="competitor[1][user_id]" class="form-control selectCUser" id="competitorUser">
				                	@foreach ($users as $user)
				                	<option value="{{$user->id}}">{{$user->name . ' ' . $user->last_name}}</option>
				                	@endforeach
				                </select>
				                @error('competitor.1.user_id')
				                    <span class="invalid-feedback d-block" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
				            </div>
				            <div class="col-5 col-md-5">
				            	<label class="lblCType mb-0" for="competitorType"><i class="far fa-user"></i> Tipo</label>
				            	<select name="competitor[1][type_id]" class="form-control selectCType" id="competitorType">
				            	@foreach ($competitor_types as $ctype)
				            		<option value="{{$ctype->id}}">{{$ctype->name . ' ' . $ctype->last_name}}</option>
				            	@endforeach
				            	</select>
				            	@error('competitor.1.type_id')
				                    <span class="invalid-feedback d-block" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
				            </div>
				            <span class="col-1 pl-0">
				            	<br>
				            	<button class="btn p-1 btn-sm mt-1 my-0 btnRemoveRow" type="button"><i class="fa fa-trash fa-2x"></i></button>
				            </span>
			            	</div>
			            	<div class="competitor-msg text-center text-danger"></div>
		            	</div>
		            </div>
		          </div>

		          <div class="buttons text-center">
		              <button type="submit" class="btn btn-primary btn-round">Crear Video</button>
		          </div>
		        </form>
		      </div>
		    </div>	
	</div>

@endsection

@section('javascript')

	<script type="text/javascript">
		$( function() {
			$(document).on('click', '.btnAddRow', function (event) {
				var user_length = {{$users->count()}};
				if($('.competitor-row').length < user_length) {
					$('.competitor-msg').text('')
					var last = $('.competitor-row:last').clone();
					last.insertAfter($('.competitor-row:last'));
					var row_length = $('.competitor-row').length
					last.find('.competitor-number').text(row_length)
					last.find('.selectCType').attr({
						'id': 'competitorType'+row_length,
						'name': 'competitor['+row_length+'][type_id]',
					})
					last.find('.lblCType').attr({
						'for': 'competitorType'+row_length,
					})
					last.find('.selectCUser').attr({
						'id': 'competitorUser'+row_length,
						'name': 'competitor['+row_length+'][user_id]',
					})
					last.find('.lblCUser').attr({
						'for': 'competitorUser'+row_length,
					})
				} else {
					$('.competitor-msg').text('Se supera el límite de usuarios')
				}
			})

			$(document).on('click', '.btnRemoveRow', function (event) {
				if($('.competitor-row').length > 1) {
					$(this).parents('.competitor-row').remove();

					$.each($('.competitor-row'), function (id, item) {
						$(this).find('.competitor-number').text(id + 1)
					})
				}
			})
			$( "#fecha_evento" ).datepicker();
		} );
	</script>
	
@endsection

