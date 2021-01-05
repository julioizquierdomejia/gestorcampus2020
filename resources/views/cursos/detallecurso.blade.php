@extends('layouts.interna', ['title' => 'Detalle del Curso'])

@section('content')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
                        <img src="/images/curso01.png" class="img-fluid" alt="Responsive image">
                    </div>

                    <div class="row row-cols-1 row-cols-md-3 mt-3">
                      <div class="col mb-4">
                        <div class="card">
                          <img src="/images/curso02.png" class="card-img-top" alt="...">
                          
                        </div>
                      </div>
                      <div class="col mb-4">
                        <div class="card">
                          <img src="/images/curso03.png" class="card-img-top" alt="...">
                          
                        </div>
                      </div>
                      <div class="col mb-4">
                        <div class="card">
                          <img src="/images/curso04.png" class="card-img-top" alt="...">
                          
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-sm-6 p-4">
                  <h2 class="title-seccion">{{$curso->fullname}}</h2>
                  <h4 class="mt-2 mb-2"><i class="fal fa-user-chart mr-2 mt-3"></i> Profesor : {{$curso->instructor}}</h4>

                    <div class="badge badge-primary text-wrap p-2 pr-3 pl-3 mt-2 mb-2" style="font-size: 14px;">
                        @if($curso->type == 1)
                          Sin costo
                        @else
                          <i class="fal fa-wallet"></i> - S/. {{$curso->price}} Soles
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                    </button>
                  
                    <p class="mt-3">
                      {{$curso->introduccion}}
                    </p>
                    @if($curso->type == 1)
                      <a href="" class="btn btn-success"><i class="fal fa-sticky-note mr-3"></i>Matriculatme</a>
                    @else
                      <a href="" class="btn btn-danger"><i class="fal fa-shopping-cart mr-3"></i>Agregar a Carrito</a>
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

@section('content')
  
@endsection
