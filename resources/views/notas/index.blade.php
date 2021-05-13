	@extends('layouts.frontend', ['title' => 'Mis notas'])

	@section('content')

	<img src="{{ asset('/images/header_perfil.png') }}" class="card-img-top" alt="Imagen del curso">

	<div class="row components_content p-5">
		<div class="row">
			<div class="col">
				<h2>Nombre : {{ $usuario->name }}</h2>
				<h3>{{$curso->fullname}}</h3>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<h5>Mi progreso</h5>
				<div class="progress">
				  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$percent}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<p>[  {{$cant_notas_existente}} evaluaciones de {{$cant_notas}} / {{round($percent)}}% ]</p>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-4">
				<h4>Mis notas </h4>

				<table class="table table-striped">
				  <thead>
				    <tr>
				    	<th>Evaluación</th>
				    	<th>Nota</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($notas as $nota)
						<tr>
					      <td>{{ $nota->name}} </td>
					      <td class="text-right">{{ round($nota->grade, 2) }} </td>
					    </tr>
					@endforeach
				  </tbody>
				</table>
			</div>
			<div class="col-8">
				@if($statusCurso == true)
					<h4>Nota Final </h4>
					@if($promedio < 11)
						<div class="alert alert-success" role="alert">
						  <span class="font-weight-bold">{{ $usuario->name }}, Ud Aprobó el curso con:
						  </span><span class="badge badge-success" style="font-size: 20px;">{{$promedio}}</span>
						</div>

						<form>
							@csrf
							<a class="btn btn-secondary" id="bnt_certificate">Gestionar su Certificado</a>

						</form>	
						<div class="mt-4" id="loading" style="opacity: 0;">
							<i class="fas fa-spinner-third fa-spin"></i> <span class="text-secondary">Revisando Certificación</span>
						</div>
					@else
						<div class="alert alert-danger" role="alert">
						  <span class="font-weight-bold">{{ $usuario->name }}, Ud desaprobo el curso con:
						  </span><span class="badge badge-danger" style="font-size: 20px;">{{$promedio}}</span>
						</div>


					@endif
				@else
					<p>{{ $usuario->name }}, Al finalizar el curso podras ver tu promedio y podras descargar tu Certificado</p>
					
				@endif


				<div class="row">
	              <div class="col">
	                <div class="alert alert-danger mt-3" id="status-curso" style="display: none;" role="alert"></div>
	              </div>
	            </div>

				{{-- Al darle click a comprar le mostramos sus datos previamente con la opcion que los pueda modificar --}}

		            <div class="row" id="form_datos" style="display: none;">
		              <div class="col">
		                <h4 class="mt-3">Confirma tus datos para la compra</h4>
		                  <span class="mb-3">Recuerda que todos los campos deben estar llenos / <b class="text-danger">la modificacion de esta información no modifica la información del perfil</b></span>

		                  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
		                    <strong>Opps</strong> Debemos de tener todos los datos completos para poder inciar con la compra.
		                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                      <span aria-hidden="true">&times;</span>
		                    </button>
		                  </div>

		                  <form id="form_input" class="mt-4">
		                    <div class="form-row">
		                      <div class="form-group col-md-4">
		                        <label for="campo_email">Email</label>
		                        <input type="email" class="form-control" id="campo_email" value="{{$usuario->user}}" required>
		                      </div>
		                      <div class="form-group col-md-4">
		                        <label for="campo_nombre">Nombre</label>
		                        <input type="text" class="form-control" id="campo_nombre" value="{{$usuario->name}}" required>
		                      </div>
		                      <div class="form-group col-md-4">
		                        <label for="campo_apellidos">Apellidos</label>
		                        <input type="text" class="form-control" id="campo_apellidos" value="{{$usuario->last_name}} {{$usuario->mothers_last_name}}">
		                      </div>
		                    </div>

		                    <div class="form-row">
		                      <div class="form-group col-md-4">
		                        <label for="inputCity">Docuento de identidad</label>
		                        <input type="text" name='document' class="form-control" id="campo_documento" value="{{$usuario->document}}">
		                      </div>
		                      <div class="form-group col-md-4">
		                        <label for="inputCity">Teléfono</label>
		                        <input type="text" name='telephone' class="form-control" id="campo_telefono" value="{{$usuario->telephone}}">
		                      </div>
		                      <div class="form-group col-md-4">
		                        <label for="inputCity">Celular</label>
		                        <input type="text" name='celular' class="form-control" id="campo_celular" value="{{$usuario->celular}}">
		                      </div>
		                    </div>

		                    <div class="form-row">
		                      <div class="form-group col-md-8">
		                        <label for="campo_direccion">Dirección</label>
		                        <input type="text" name='address' class="form-control" id="campo_direccion" value="{{$usuario->address}}">
		                      </div>
		                      <div class="form-group col-md-4">
		                        <label for="inputCity">Urbanización</label>
		                        <input type="text" name='urbanizacion' class="form-control" id="campo_urbanizacion" value="{{$usuario->urbanizacion}}">
		                      </div>
		                    </div>

		                    <div class="form-row">
		                      <div class="form-group col-md-3">
		                        <label for="inputCity">País</label>
		                        <input type="text" name='country' class="form-control" id="campo_pais" value="{{$usuario->country}}">
		                      </div>
		                      <div class="form-group col-md-3">
		                        <label for="campo_provincia">Provincia</label>
		                        <input type="text" name='provincia' class="form-control" id="campo_provincia" value="{{$usuario->provincia}}">
		                      </div>
		                      <div class="form-group col-md-3">
		                        <label for="campo_ciudad">Ciudad</label>
		                        <input type="text" name='city' class="form-control" id="campo_ciudad" value="{{$usuario->city}}">
		                      </div>
		                      <div class="form-group col-md-3">
		                        <label for="inputCity">Distrito</label>
		                        <input type="text" name='distrito' class="form-control" id="campo_distrito" value="{{$usuario->distrito}}">
		                      </div>
		                    </div>
		                    
		                    <!--button type="submit" class="btn btn-success"><i class="far fa-credit-card"></i> Pagar - CheckOut</button-->
		                    <a class="btn btn-success" id="btn_pagar"><i class="fab fa-cc-visa mr-2"></i>Pagar - CheckOut</a>

		                    <a class="btn btn-danger" id="btn_cancelar"><i class="far fa-trash-alt"></i> Cancelar</a>
		                  </form>
		              </div>
		            </div>
		        {{-- fin de formulario de datos adicionales --}}

			</div>
		</div>

		
	</div>


	@endsection



	@section('javascript')

            <script type="text/javascript">

              $(document).ready(function(){

              //inicializando variables
              Culqi.publicKey = 'pk_test_3b370432f6d56e22';

              // Capturamos las variables de los input Variables de los inputs 
              capturarValoresDelForm();

              $('#status-curso').hide()

              //Le damos actividad al boton para mostrar y/o oculatar el fomulario de datos
              $( ".btn_comprar" ).click(function() {
                $( "#form_datos" ).toggle( "slow", function() {
                // Animation complete.
                });
              });

              $( "#btn_cancelar" ).click(function() {
                $( "#form_datos" ).toggle( "slow", function() {
                // Animation complete.
                });
              });


              //configuración y functions para CULQUI
              $('#btn_pagar').on('click', function(e) {

                  $('#status-curso').hide("slow");
                  //hacemos primero la validacion de los campos del input
                  email = $('#campo_email').val();
                  nombre = $('#campo_nombre').val();
                  apellidos = $('#campo_apellidos').val();
                  direccion = $('#campo_direccion').val();
                  telefono = $('#campo_telefono').val();

                  if(email == "" | nombre == "" | apellidos == "" | direccion == "" | telefono == ""){
                    $('#status-curso').show("slow");
                    $('#status-curso').html('Para continuar debes de llenar todos los datos')
                  }else{
                    // Abre el formulario con la configuración en Culqi.settings
                    Culqi.open();
                    e.preventDefault();
                  }

              });

              Culqi.settings({
                title: 'ASPEFAM - Campus',
                currency: 'PEN',
                description: '{{$curso->fullname}}',
                email : "test@culqi.com",
                amount: parseInt('{{$curso->price}}'+'00'),
              });

              Culqi.options({
                //lang: 'auto',
                modal: true,
                //installments: true,
                //customButton: 'Donar',
                style: {
                  logo: "{{ asset('/images/isotipo.png') }}",
                  maincolor: '#1D1FE7',
                  buttontext: '#ffffff',
                  maintext: '#4A4A4A',
                  desctext: '#4A4A4A'
                }
              });

              //Listeners para el onchage de losinputs para cuando se actualicen
              $( "#campo_direccion" ).change(function() {
                direccion = $(this).val();
              });

              $( "#campo_telefono" ).change(function() {
                telefono = $(this).val();
              });

              $( "#campo_email" ).change(function() {
                email = $(this).val();
              });

              $( "#campo_nombre" ).change(function() {
                nombre = $(this).val();
              });


            }) //aqui acaba el $(document).ready()


              //funcion que se encarga de capturar los datos del formulario
              function capturarValoresDelForm(){
                email = $('#campo_email').val();
                nombre = $('#campo_nombre').val();
                apellidos = $('#campo_apellidos').val();
                
                documento = $('#campo_direccion').val();
                telefono = $('#campo_telefono').val();
                celular = $('#campo_celular').val();

                direccion = $('#campo_direccion').val();
                urbanizacion = $('#campo_urbanizacion').val();
                pais = $('#campo_pais').val();
                provincia = $('#campo_provincia').val();
                ciudad = $('#campo_ciudad').val();
                distrito = $('#campo_distrito').val();
              }
              

            var input_curso_id = $('input[name=course_id]').val();
            var input_user_id = $('input[name=user_id]').val();

            function culqi() {
              if (Culqi.token) { // ¡Objeto Token creado exitosamente!
                  var token = Culqi.token.id;
                  var data = { 
                    id:'1', 
                    producto:'{{$curso->fullname}}',
                    precio: parseInt('{{$curso->price}}'+'00'),
                    token:token,
                    customer_id: parseInt('{{$user->document}}'),
                    address: direccion, //'Mz A2 Lote 9 - Santa Ana - Los olivos', //"{{$usuario->address}}",
                    address_city: "{{$user->address}}",
                    first_name: nombre, //"{{$user->name}}",
                    last_name: apellidos, //"{{$user->last_name}}",
                    email: email,
                    telephone: telefono, //"{{$usuario->celular}}",
                    celular: celular,
                  };//Aquí termina la DATA

                  //dataStr = data;

                  //aqui lanzamos el cargador
                  $("#miModal").modal("show");

                  var url = "/plugins/proceso.php";

                  $.post(url,data,function(res){ //Envio de informacion por AJAX al proceso de pago de Culqui
                    
                    //alert(' Tu pago se Realizó con ' + res + '. Agradecemos tu preferencia.');
                    //definimos las variables con el valor de los inputs hidden del form
                    //necesario para grabar en el carrito de compras 
                    //ShopingCarts

                    registrarLaMatricula();

                    //aqui lanzamos el cargador
                    $("#miModal").modal("hide");

                    if (res=="exito") {
                      //pdf();
                      //alert(res);
                      $('#btn_pagar').hide("slow");
                      $('#status-curso').show("slow");
                      $('#status-curso').html('Curso comprado');

                      $( "#form_datos" ).hide("slow");

                    }else{
                      //alert(res);
                      $('#btn_pagar').hide("slow");
                      $('#status-curso').show("slow");
                      $('#status-curso').html('No se logró comprar el curso, intentelo nuevamente');
                      
                    }
                  }); //Aquí termna el AJAX de Culqui

              
              
              } else { // ¡Hubo algún problema!
                  // Mostramos JSON de objeto error en consola
                  console.log(Culqi.error);
                  alert(Culqi.error.user_message);
              }
            };

            function registrarLaMatricula(){

              
              $.ajax({
                  //url: "/shopping",
                  url: "{{ route('shopping.storeCertificate') }}",
                  method: 'POST',
                  data:{
                    _token:$('input[name="_token"]').val(),
                    //info para registrar la matriculacion
                    course_id : "{{$curso->id}}",
                    user_id : '{{ Auth::user()->id }}',

                    //info para registrar la compra en la tabla Shopings
                    name : nombre,
                    last_name : apellidos,
                    address : direccion,

                    document : documento,
                    telephone : telefono,
                    celular : celular,

                    address : direccion,
                    urbanizacion : urbanizacion,
                    country : pais,
                    provincia : provincia,
                    city : ciudad,
                    distrito : distrito,

                  }
                }).done(function(res){
                  //alert(res);
                })
            }


            $('#bnt_certificate').click(function(){
			$('#loading').css('opacity', 1);
			
			$.ajax({
		      //url: "/shopping",
		      url: "{{ route('certificate.searchCertificate') }}",
		      method: 'POST',
		      data:{
		        _token:$('input[name="_token"]').val(),
		        //info para registrar la matriculacion
		        id : "{{$curso->course_moodle_id}}", //enviamos el ID del curso de moodle

		      }
		    }).done(function(res){
		    	$('#loading').css('opacity', 0);

		    	if(res == 1){//debe de pagar el certificado
		    		//$('#form_datos').show('slow');
		    		alert(res)

		    	}else{//si no solo debe de generarlo
		    		alert(res);
		    	}


		      //alert(res);
		      //alert('matriculacion')
		    })
		})

            </script>

          @endsection




