          @extends('layouts.frontend', ['title' => 'Detalle del Curso'])

          @section('content')


          <!-- Modal -->

          <div class="modal fade" id="modalProcesando" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  Procesando Matricula
                </div>
              </div>
            </div>
          </div>

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
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            @if($statusCourse == false)
                                @if($curso->type == 2)
                                  <a class="btn btn-primary btn_comprar" id="btn_comprar_curso"><i class="fab fa-cc-visa mr-2"></i>Comprar Curso</a>
                                @else
                                  <form>
                                    @csrf
                                    <a class="btn btn-success" id="btn_matricula"><i class="fal fa-sticky-note mr-3"></i>Matricularme</a>
                                  </form>
                                @endif
                              @else
                                <div class="badge badge-primary text-wrap p-2 pr-3 pl-3 mt-2 mb-2" style="font-size: 14px;">
                                  Ya te encuentras inscrito en este curso
                                </div>
                              @endif
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="alert alert-danger mt-3" id="status-curso" style="display: none;" role="alert"></div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="alert alert-success mt-3" id="status-curso_2" style="display: none;" role="alert"></div>
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

                                <h5 class="mt-2">Tipo de Documento</h5>
                                <div class="form-row mb-4">
                                  <div class="form-check form-check-inline ml-2">
                                    <input class="form-check-input" type="radio" name="document_type" id="boleta" value="2" checked>
                                    <label class="form-check-label" for="boleta">Boleta de Venta</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="document_type" id="factura" value="1">
                                    <label class="form-check-label" for="factura">Factura</label>
                                  </div>
                                </div>

                                <div class="form-row">
                                  <div class="form-group col-md-4">
                                    <label for="campo_direccion">Ruc</label>
                                    <input type="text" name='ruc' class="form-control" id="ruc" value="">
                                  </div>
                                  <div class="form-group col-md-8">
                                    <label for="inputCity">Razon Social</label>
                                    <input type="text" name='business_name' class="form-control" id="business_name" value="">
                                  </div>
                                </div>
                                
                                <!--button type="submit" class="btn btn-success"><i class="far fa-credit-card"></i> Pagar - CheckOut</button-->
                                <a class="btn btn-success" id="btn_pagar"><i class="fab fa-cc-visa mr-2"></i>Pagar - CheckOut</a>

                                <a class="btn btn-danger" id="btn_cancelar"><i class="far fa-trash-alt"></i> Cancelar</a>
                              </form>
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

                        <div class="docs">
                          
                        </div>

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

                    <form id="form_info_cart">
                      @csrf
                        <input type="hidden" name="course_id" value="{{$curso->id}}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </form>

                    </div>
                  </div>


          @endsection

          @section('javascript')

            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                  

                  if($('input:radio[name=document_type]:checked').val() == 2){

                    //hacemos primero la validacion de los campos del input si es boleta
                    email = $('#campo_email').val();
                    nombre = $('#campo_nombre').val();
                    dni = $('#campo_documento').val();
                    apellidos = $('#campo_apellidos').val();
                    direccion = $('#campo_direccion').val();
                    telefono = $('#campo_telefono').val();

                    if(email == "" | nombre == "" | apellidos == "" | direccion == "" | telefono == "" | dni == ""){
                      $('#status-curso').show("slow");
                      $('#status-curso').html('Para continuar debes de llenar todos los datos')
                    }else{
                      // Si todos los datos estan correctos 
                      // Abre el formulario con la configuración en Culqi.settings
                      Culqi.open();
                      e.preventDefault();
                    }

                  }else{

                    //hacemos primero la validacion de los campos del input si es Factura
                    email = $('#campo_email').val();
                    nombre = $('#campo_nombre').val();
                    apellidos = $('#campo_apellidos').val();
                    dni = $('#campo_documento').val();
                    direccion = $('#campo_direccion').val();
                    telefono = $('#campo_telefono').val();
                    ruc = $('#ruc').val();
                    business_name = $('#business_name').val();

                    if(email == "" | nombre == "" | apellidos == "" | direccion == "" | telefono == "" | ruc == "" | business_name == "" | dni == ""){
                      $('#status-curso').show("slow");
                      $('#status-curso').html('Para continuar debes de llenar todos los datos / Incluyendo RUC y Razon Social')
                    }else{
                      // Si todos los datos estan correctos 
                      // Abre el formulario con la configuración en Culqi.settings
                      Culqi.open();
                      e.preventDefault();
                    }

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

              $( "#campo_documento" ).change(function() {
                dni = $(this).val();
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
                dni = $('#campo_documento').val();
                urbanizacion = $('#campo_urbanizacion').val();
                pais = $('#campo_pais').val();
                provincia = $('#campo_provincia').val();
                ciudad = $('#campo_ciudad').val();
                distrito = $('#campo_distrito').val();

                document_type = $('input:radio[name=document_type]:checked').val();
                ruc = $('#ruc').val();
                business_name = $('#business_name').val();

                //calcular costo base e IGV
                precio = parseInt('{{$curso->price}}');
                costo_base = precio / 1.18;
                IGV =  precio - costo_base;


              }
              

            var input_curso_id = $('input[name=course_id]').val();
            var input_user_id = $('input[name=user_id]').val();

            function culqi() {
              $("#modalProcesando").modal("show");
              if (Culqi.token) { // ¡Objeto Token creado exitosamente!
                  var token = Culqi.token.id;
                  var data = { 
                    id:'{{$curso->id}}',
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

                  //aqui lanzamos el cargador
                  $("#miModal").modal("show");

                  var url = "/plugins/proceso.php";

                  $.post(url,data,function(res){ //Envio de informacion por AJAX al proceso de pago de Culqui
                    
                    //alert(' Tu pago se Realizó con ' + res + '. Agradecemos tu preferencia.');
                    //definimos las variables con el valor de los inputs hidden del form

                    if (res=="exito") { // si se procesar el Pago, se procede con la genracion del documento a la Sunat

                      //pdf();
                      //alert(res);
                      $('#btn_pagar').hide("slow");
                      $('#status-curso').show("slow");
                      $('#status-curso').html('Curso comprado');
                      $('#btn_comprar_curso').hide('slow');

                      $( "#form_datos" ).hide("slow");


                      //ahora lanzamos el ajax para NUBEFACT
                      var url_fact = "/plugins/nubeFact-json2.php";

                      var data_fact = {
                        
                      }

                      var num_doc = 0;
                      //segun el valor del tipo de documento traemos el ultimo nuero del documento
                      //si es 1 es Factura
                      //si es 2 es boleta
                      //definimos la url y la data

                      $.ajax({
                        url: "{{ route('shopping.getTypeDoc') }}",
                        method: 'POST',
                        data:{
                          _token:$('input[name="_token"]').val(),
                          //info para registrar la matriculacion
                          type : $('input:radio[name=document_type]:checked').val(), 

                        }
                      }).done(function(res){
                        //aqui ocultamos el cargador
                        
                        num_doc = res; //parseInt(res)+1;

                        //luego de obtener el ultimo numero del documento a emitir
                        //hacmeos el proceso de generacion del docuemnto

                        if($('input:radio[name=document_type]:checked').val() == 2){
                          var data_fact = {
                            id:'{{$curso->id}}',
                            numero:num_doc,
                            serie:'2',
                            producto:'{{$curso->fullname}}',
                            precio: precio, // parseInt('{{$curso->price}}'+'00'),
                            costo_base: costo_base,
                            IGV: IGV,
                            producto:'{{$curso->fullname}}',
                            token:token,
                            customer_id: parseInt('{{$user->document}}'),
                            address: direccion, //'Mz A2 Lote 9 - Santa Ana - Los olivos', //"{{$usuario->address}}",
                            address_city: "{{$user->address}}",
                            first_name: nombre, //"{{$user->name}}",
                            last_name: apellidos, //"{{$user->last_name}}",
                            email: email,
                            telephone: telefono, //"{{$usuario->celular}}",
                            document_type_string: 'FFF1',
                            document_type: document_type,
                            ruc: parseInt(dni),
                            business_name: nombre,
                            codigo_unico: '{{$curso->id}}' + num_doc,
                          }
                        }else{
                          var data_fact = {
                            id:'{{$curso->id}}',
                            numero: num_doc,
                            serie: '1',
                            producto:'{{$curso->fullname}}',
                            precio: precio, //parseInt('{{$curso->price}}'+'00'),
                            costo_base: costo_base,
                            IGV: IGV,
                            producto:'{{$curso->fullname}}',
                            token:token,
                            customer_id: parseInt('{{$user->document}}'),
                            address: direccion, //'Mz A2 Lote 9 - Santa Ana - Los olivos', //"{{$usuario->address}}",
                            address_city: "{{$user->address}}",
                            first_name: nombre, //"{{$user->name}}",
                            last_name: apellidos, //"{{$user->last_name}}",
                            email: email,
                            telephone: telefono, //"{{$usuario->celular}}",
                            document_type_string: 'FFF1',
                            document_type: document_type,
                            ruc: ruc,
                            business_name: business_name,
                            codigo_unico: '{{$curso->id}}' + num_doc,
                          }
                        }

                        $.post(url_fact,data_fact,function(res){ //Envio de informacion por AJAX a NUBEFACT
                          $("#modalProcesando").modal("hide");
                          $('.docs').html(res);

                          //luego de procesar el pago y posteriormente generar el documento con exito
                          //se procede a hacer la matricula en el sistema de gestion de aspefam

                          

                          registrarLaMatricula();

                        }); //Aquí termna el AJAX de NUBEFACT

                        
                      })


                    }else{  // si no se procesa el pago de la pasarela se envia mensaje al front
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

              $("#modalProcesando").modal("show");
              console.log('Inicio matricula');
              
              $.ajax({
                  //url: "/shopping",
                  url: "{{ route('shopping.store') }}",
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

                    //link_document : link,

                    document_type : document_type,
                    ruc : ruc,
                    business_name : business_name,


                  }
                }).done(function(res){
                  //alert(res);
                  //aqui ya se resuelve la compra
                  $("#modalProcesando").modal("hide");
                  console.log('Acabo matricula');

                })
            }

            //esta funcion solo matricula para cursos PostPago
            function registrarLaEnrollments(){
              //aqui lanzamos el cargador
              $("#modalProcesando").modal("show");
              console.log('Inicio matricula');
              
              $.ajax({
                  //url: "/shopping",
                  url: "{{ route('shopping.enrollment') }}",
                  method: 'POST',
                  data:{
                    _token:$('input[name="_token"]').val(),
                    //info para registrar la matriculacion
                    course_id : "{{$curso->id}}", //input_curso_id,
                    user_id : "{{ Auth::user()->id }}", //input_user_id,

                  }
                }).done(function(res){
                  //aqui ocultamos el cargador
                  $("#modalProcesando").modal("hide");
                  $('#btn_matricula').hide("slow");
                  $('#status-curso_2').html('Gracias ya te encuentras Matriculado en este curso');
                  $('#status-curso_2').show('slow');

                  $(document).scrollTop();
                  
                })
            }

            $('#btn_matricula').click(function(){
              registrarLaEnrollments()
            })


            </script>

          @endsection
