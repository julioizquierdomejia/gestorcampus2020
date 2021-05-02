  @extends('layouts.frontend', ['title' => 'Detalle del Curso'])

  @section('content')



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Matrícula - {{$curso->fullname}}</h5>
          <!--button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button-->
        </div>
        <div class="modal-body">
          <h6 class="mt-2 mb-2"><i class="fal fa-user-chart mr-2 mt-3"></i> Profesor : {{--$curso->instructor--}}
              @foreach($instructores as $ins)
                - {{ $ins->name }}
              @endforeach
          </h6>
          <p class="mt-3">
            {{$curso->introduccion}}
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Lo quiero</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="modal_sincosto" tabindex="-1" aria-labelledby="modal_sincosto" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_sincosto">Terminos y condiciones para los Cursos sin costo</h5>
          <!--button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button-->
        </div>
        <div class="modal-body">
          <p class="mt-3">
            El curso enmención tiene una categoría de sin costo, lo cual indica que se puede llevar el curso sin hacer algun tipo de pago previo
            si Ud estudiante logra terminar el curso con notas aprobatorias, puede generar un ceretificado el cual va a dar constancia que ud
            terminó y el curso y aprobo
          </p>

          <p>
            Dicho Certificado, tienen un costo de S/. {{$curso->price}} Soles
          </p>
        </div>
        <div class="modal-footer">
          <!--button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Lo quiero</button-->
        </div>
      </div>
    </div>
  </div>

     <div class="container mt-5">
            <div class="row">
              <div class="col-sm-9 p-3">
                <div class="row">
                  <div class="col-sm-6 p-4">
                      <div class="row">
                          <img src="{{ asset('/images/images_cursos/'.$curso->img) }}" class="img-fluid" alt="Responsive image">
                      </div>

                      {{--
                      <div class="row row-cols-1 row-cols-md-3 mt-3">
                        <div class="col mb-4">
                          <div class="card">
                            <img src="{{ asset('/images/curso02.png') }}" class="card-img-top" alt="...">
                            
                          </div>
                        </div>
                        <div class="col mb-4">
                          <div class="card">
                            <img src="{{ asset('/images/curso03.png') }}" class="card-img-top" alt="...">
                            
                          </div>
                        </div>
                        <div class="col mb-4">
                          <div class="card">
                            <img src="{{ asset('/images/curso04.png') }}" class="card-img-top" alt="...">
                            
                          </div>
                        </div>
                      </div>
                      --}}
                  </div>
                  <div class="col-sm-6 p-4">
                    <h2 class="title-seccion">{{$curso->fullname}}</h2>

                    @foreach($tags as $tag)
                      <span class="badge badge-pill p-2 px-3" style="background-color: {{ $tag->color  }}; color: white">{{ $tag->name }}</span>
                    @endforeach

                    <h4 class="mt-2 mb-2"><i class="fal fa-user-chart mr-2 mt-3"></i> Profesor : 

                      @foreach($instructores as $ins)
                      <br>
                        {{ $ins->name }}
                      @endforeach

                      </h4>
                      @if($curso->type == 1)
                        Sin costo de participación
                      @else
                        <div class="badge badge-primary text-wrap p-2 pr-3 pl-3 mt-2 mb-2" style="font-size: 14px;">
                          <i class="fal fa-wallet"></i> - S/. {{$curso->price}} Soles
                        </div>
                      @endif

                      <p class="">
                        Para poder adquirir el certificado del Curso, luego de haberlo aprobado, deberá de hacer una inversión.
                        Para mas información, 
                        <p>
                          <a href="" type="button" class="btn btn-success p-1 px-2" data-toggle="modal" data-target="#modal_sincosto">
                            <i class="far fa-engine-warning"></i> Hacer click Aquí.
                          </a>
                        </p>
                      </p>
                      
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <h3>Breve Introducción</h3>
                    <p class="mt-3">
                        {{$curso->introduccion}}
                      </p>
                      
                      {{-- Primero vamos a revisar si el usuario esta logeado --}}
                        @if (Route::has('login'))
                          @auth
                            @if($curso->type == 1) {{-- Si esta logeado preguntamos si es un curso postPago --}}
                              <a href="" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fal fa-sticky-note mr-3"></i>Matriculatme</a>
                            @else {{-- Si es Prepago mostrmaos los botones de compra y carrito --}}
                              <form id="form_info_cart">
                                @csrf
                                  <input type="hidden" name="course_id" value="{{$curso->id}}">
                                  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">                            
                              </form>
                              {{--
                              <a href='#' class="btn btn-danger" id="addCart" data-courseTitle={{$curso}}><i class="fal fa-shopping-cart mr-2"></i>Agregar al Carrito</a>
                              --}}
                              <a class="btn btn-primary" id="btn_comprar"><i class="fab fa-cc-visa mr-2"></i>Comprar Curso</a>
                                <div class="alert alert-danger mt-3" id="status-curso" style="display: none;" role="alert">
                                
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

                            @endif
                          @else {{-- Si no estas logeado sale una advertencia --}}
                            <div class="alert alert-danger" role="alert">
                              Para poder Matricularte necesitas estar Logeado <a href="{{ route('login') }}" class="btn btn-primary mx-2">Acceder</a> si no estas registrado, regístrate <a href="{{ route('register') }}" class="btn btn-danger mx-2">Aquí</a>
                            </div>
                          @endif
                        @endif
                      {{-- End of if login--}}
                  </div>
                </div>


                <!--------------------->
                <div class="row">
                  <div class="col">
                      <!-- Tabs -->
                      <nav class="mt-5">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-tinku" role="tab" aria-controls="nav-home" aria-selected="true">Descripción</a>
                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-moc" role="tab" aria-controls="nav-profile" aria-selected="false">Información Adicional</a>
                          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-otros" role="tab" aria-controls="nav-contact" aria-selected="false">Novedades</a>
                        </div>
                      </nav>
                      <div class="tab-content p-3 mt-3" id="nav-tabContent">
                          <!-- Detalle TAB Tinku -->
                          <div class="tab-pane fade show active" id="nav-tinku" role="tabpanel" aria-labelledby="nav-home-tab">
                              {{$curso->description}}
                          </div>
                          <!-- END Detalle TAB Tinku -->


                          <!-- Detalle TAB MOC -->
                          <div class="tab-pane fade" id="nav-moc" role="tabpanel" aria-labelledby="nav-home-tab">
                              {{$curso->Informacion_adicional}}
                          </div>
                          <!-- END Detalle TAB MOC -->

                          <!-- Detalle TAB Otros -->
                          <div class="tab-pane fade" id="nav-otros" role="tabpanel" aria-labelledby="nav-home-tab">
                              {{$curso->novedades}}
                          </div>
                          <!-- END Detalle TAB OTROS -->

                      </div>

                      <!-- end Tabs -->
                  </div>
              </div>
                <!--------------------->


              </div>
              <div class="col-sm-3 p-4">
                <h3 class="mb-3">Cursos relacionados</h3>

                  @foreach($cursos as $item)
                      @if($item->categoria == $curso->categoria)
                          <p>{{$item->shortname}}</p>
                      @endif
                  @endforeach

                  <h3 class="mt-5 mb-3">Nuevos Cursos</h3>
                  @foreach($cursos as $item)
                      @if($item->categoria == $curso->categoria)
                          <p>{{$item->shortname}}</p>
                      @endif
                  @endforeach


              </div>
            </div>
          </div>


  @endsection

  @section('javascript')

    <script type="text/javascript">
      
      $(document).ready(function(){

        //inicializando variables
        Culqi.publicKey = 'pk_test_3b370432f6d56e22';
        //Variables de los inputs 
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

        $('#status-curso').hide()

        //Le damos actividad al boton para mostrar y/o oculatar el fomulario de datos
        $( "#btn_comprar" ).click(function() {
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
            };//Aquí termina la DATA

            //dataStr = data;

            var url = "/plugins/proceso.php";

            $.post(url,data,function(res){ //Envio de informacion por AJAX al proceso de pago de Culqui
              
              //alert(' Tu pago se Realizó con ' + res + '. Agradecemos tu preferencia.');
              //definimos las variables con el valor de los inputs hidden del form
              //necesario para grabar en el carrito de compras 
              //ShopingCarts
              var input_curso_id = $('input[name=course_id]').val();
              var input_user_id = $('input[name=user_id]').val();

              $.ajax({
                url: "/shopping",
                method: 'POST',
                data:{
                  _token:$('input[name="_token"]').val(),
                  //info para registrar la matriculacion
                  course_id : input_curso_id,
                  user_id : input_user_id,

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
                alert(res);
              })

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



      /*
    $("#form_input").validate();


    //Ajax ShoopingCarts
    $('#addCart').click(function(){
      //definimos las variables con el valor de los inputs hidden del form
      //necesario para grabar en el carrito de compras 
      //ShopingCarts
      var input_curso_id = $('input[name=course_id]').val();
      var input_user_id = $('input[name=user_id]').val();

      $.ajax({
        url: "/carrito",
        method: 'POST',
        data:{
          _token:$('input[name="_token"]').val(),
          course_id : input_curso_id,
          user_id : input_user_id,
        }
      }).done(function(res){
        alert(res);
      })


    }) // Aqui acaba el ajax del carrito


    
  */

    </script>

  @endsection
