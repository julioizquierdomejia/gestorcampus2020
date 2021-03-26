@extends('layouts.interna', ['title' => 'Detalle del Curso'])

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
        <h6 class="mt-2 mb-2"><i class="fal fa-user-chart mr-2 mt-3"></i> Profesor : {{$curso->instructor}}</h6>
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

                  <h4 class="mt-2 mb-2"><i class="fal fa-user-chart mr-2 mt-3"></i> Profesor : {{$curso->instructor}}</h4>
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
                    @if($curso->type == 1)
                      <a href="" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fal fa-sticky-note mr-3"></i>Matriculatme</a>
                    @else
                      <a href="" class="btn btn-danger" id="btn_pagar"><i class="fal fa-shopping-cart mr-3"></i>Comprar Curso</a>
                    @endif
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
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </p>


            </div>
          </div>
        </div>


@endsection

@section('javascript')
  
  <script type="text/javascript">
    Culqi.publicKey = 'pk_test_3b370432f6d56e22';

    Culqi.settings({
      title: 'ENAM',
      currency: 'PEN',
      description: 'CURSO ASPEFAM 01',
      amount: 3500
    });

    $('#btn_pagar').on('click', function(e) {
      // Abre el formulario con la configuración en Culqi.settings
      Culqi.open();
      e.preventDefault();
  });

  function culqi() {
    if (Culqi.token) { // ¡Objeto Token creado exitosamente!
        var token = Culqi.token.id;
        var data = { 
          id:'1', 
          producto:'Productos varios. Frank Moreno', 
          precio: 15000, 
          token:token, 
          customer_id: "06813928",
          address: "los olivos",
          address_city: "Lima",
          first_name: "Julio",
          email: 'julio.izquierdo.mejia@gmail.com' 
        };

        //dataStr = data;

        var url = "/plugins/proceso.php";

        $.post(url,data,function(res){
          alert(' Tu pago se Realizó con ' + res + '. Agradecemos tu preferencia.');
          if (res=="exito") {
            //pdf();
          }else{
            alert("No se logró realizar el pago.");
          }
        });

    
    
    } else { // ¡Hubo algún problema!
        // Mostramos JSON de objeto error en consola
        console.log(Culqi.error);
        alert(Culqi.error.user_message);
    }
  };

  </script>


@endsection
