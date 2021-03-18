<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


    <link href="{{ asset('css/campus.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    <title>Campus Aspefam</title>
  </head>
  <body>
    <div class="contenedor navheader d-flex justify-content-end mt-3">
        <nav>

            @if (Route::has('login'))
                    @auth
                        <span> Bienvenido : {{ Auth::user()->email }} </span>
                        {{-- Verificamos si es super admin irole_id = 9 --}}
                        @if(Auth::user()->roles->first()->pivot->role_id == 9)
                          <a href="{{ route('perfil') }}" class="btn btn-success">Mi área personal</a>
                          <a href="{{ url('/home') }}" class="btn btn-primary">Administrador</a>
                          <a href="{{ route('logout') }}" class="btn btn-danger">Cerrar Sessión</a>
                        @else
                          <a href="{{ route('perfil') }}" class="btn btn-success">Mi área personal</a>
                          <a href="{{ route('logout') }}" class="btn btn-danger">Cerrar Sessión</a>
                        @endif
                        
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Acceder</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-danger">Registrate</a>
                        @endif
                    @endif
            @endif

        </nav>
    </div>

    <div class="contenedor bg-white containerBody">

        <div class="header">
            <div class="row">
                <div class="col-sm-6 logo d-flex align-items-center">
                    <a href="/">
                        <img src=" {{ aset('assets/img/logo_header.png' ) }} ">
                    </a>
                </div>
                <div class="col socialButtons">
                    <ul class="d-flex justify-content-end align-items-center h-100">
                        <li>
                            <a href="" class="bg-facebook"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="" class="bg-twitter"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="" class="bg-fliker"><i class="fab fa-flickr"></i></a>
                        </li>
                        <li>
                            <a href="" class="bg-youtube"><i class="fab fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="https://www.aspefam.org.pe/" class="bg-blueaspefam"><i class="fal fa-globe-americas"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="barheader">
            la casita
        </div>

        <div class="slider">
            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-interval="10000">
                  <img src="images/portada1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-interval="2000">
                  <img src="images/portada2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="images/portada3.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>

        <div class="content">

          
          <div class="row">
            <div class="col">
              


            </div>
          </div>



          <div class="row">
            <div class="col p-5">
              <h2 class="title-seccion">Nuestros Cursos</h2>

              <!-- opcion para filtros 
              <h5 class="mt-4">Encuéntralos según tu interes</h5>
              <div class="btn-group" role="group" aria-label="Basic example">
                @foreach($tags as $key => $tag)
                  <button type="button" class="btn opc-tag" id='group-{{$tag->id}}' data-id="{{$tag->id}}" style="border-color: {{$tag->color}}"> <i class="fas fa-circle" style="color: {{$tag->color}}"></i> {{ $tag->name }} </button>
                @endforeach
              </div>
              -->

              <!-- las pestañas de navegacion de cursos -->
             <nav class="mt-5">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  @foreach($grupos_iterados as $grupo)
                  <a class="nav-item nav-link @if ($loop->first) active @endif" id="nav-home-tab_" data-toggle="tab" href="#B{{$grupo[0]}}" role="tab" aria-controls="nav-home_" aria-selected="true">{{$grupo[1]}}</a>
                  @endforeach
                </div>
              </nav> 
              <!-- Fin de las pestañas de navegacion de cursos -->
              
              <!-- Contenido de las pestañas lista de cursos -->
              <div class="tab-content p-4" id="nav-tabContent">
                @foreach($grupos_iterados as $grupo)
                  <div class="tab-pane fade @if ($loop->first) show active @endif" id="B{{$grupo[0]}}" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row row-cols-1 row-cols-md-5 row-courses">
                      @foreach($cursos as $curso)
                        @if($curso->course_group_id == $grupo[0] )
                          <div class="col mb-4 item">
                            <div class="card">
                              <a href=" {{ route('curso.detail', $curso->id) }}">
                                <img src="images/curso0{{$curso->id}}.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <div>
                                    @foreach($cuorse_tags as $key => $tag)
                                      @if($tag->course_id == $curso->id)
                                        <i class="fas fa-circle" style="color: {{$tag->color}}"></i>
                                      @endif
                                    @endforeach
                                  </div>
                                  <h5 class="card-title">{{ $curso->shortname  }}</h5>
                                  <p class="card-text"></p>
                                </div>  
                              </a>
                            </div>
                          </div>
                        @endif
                      @endforeach
                    </div>
                  </div>
                @endforeach
              </div> 
              <!-- Fin de Contenido de las pestañas lista de cursos -->

            </div>
          </div>

            <!-- acerca de -->
            <div class="row">
                <div class="col-sm-6 p-5">
                    <h2 class="title-seccion">Acerca del Campus</h2>
                    <p class="mt-4">
                      El Campus Virtual de Educación Médica de ASPEFAM es una plataforma diseñada para codyuvar al fortalecimiento de una educación médica de calidad, a través de la implementación de programas, cursos, seminarios, conferencias y otras actividades formativas que se desarrollan en la modalidad virtual. Nuestro propósito es diseñar contenidos educativos actualizados y de la más alta calidad, para lo cual, ASPEFAM congrega a profesionales de reconocido prestigio nacional e internacional que ponen su experticia al servicio de la educación médica. 
                    </p>
                    <a href="/acercade" class="btn btn-info text-white mt-5 px-3 py-2 btn-campus-call">Mayor información</a>
                    
                </div>
                <div class="col-sm-6 p-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row row-cols-1 row-cols-md-2">
                              <div class="col mb-4">
                                <div class="card card-about" id="card_about_1">
                                    <div class="card-over"></div>
                                    <img class="img-card-info" src="{{ asset('/images/image_01.png') }}">
                                  <div class="card-body">
                                  </div>
                                </div>
                              </div>

                              <div class="col mb-4">
                                <div class="card card-about" id="card_about_2">
                                    <div class="card-over"></div>
                                    <img class="img-card-info" src="{{ asset('/images/image_02.png') }}">
                                  <div class="card-body">
                                  </div>
                                </div>
                              </div>

                              <div class="col mb-4">
                                <div class="card card-about" id="card_about_3">
                                    <div class="card-over"></div>
                                    <img class="img-card-info" src="{{ asset('/images/image_03.png') }}">
                                  <div class="card-body">
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end acerca de -->

            <!-- Iconos informativos -->
            <div class="row p-5 row-icons-info">
                <div class="col-12 col-sm2- col-lg-3 p-5 col-icons-info">
                    <div class="box-icon-info d-flex align-items-center justify-content-center">
                      <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4 class="text-center mt-4 mb-2">Certificacion</h4>
                    <p class="text-center">Los cursos son gratuitos; y sólo se pagará un costo módico por concepto de certificación con auspicio universitario.
                    </p>
                </div>
                <div class="col-12 col-sm2- col-lg-3 p-5 col-icons-info">
                    <div class="box-icon-info d-flex align-items-center justify-content-center">
                      <i class="fas fa-cubes"></i>
                    </div>
                    <h4 class="text-center mt-4 mb-2">Sistema Modular</h4>
                    <p class="text-center">Puedes estudiar de acuerdo a tu disponibilidad temporal y obtener tus certificados de forma progresiva.
                    </p>
                </div>
                <div class="col-12 col-sm2- col-lg-3 p-5 col-icons-info">
                    <div class="box-icon-info d-flex align-items-center justify-content-center">
                      <i class="fal fa-laptop"></i>
                    </div>
                    <h4 class="text-center mt-4 mb-2">Multidispositivo</h4>
                    <p class="text-center">Accede a tus cursos por internet desde cualquier tipo de dispositivo como P,c, tablet o celular.
                    </p>
                </div>
                <div class="col-12 col-sm2- col-lg-3 p-5 col-icons-info">
                    <div class="box-icon-info d-flex align-items-center justify-content-center">
                      <i class="fal fa-calendar-check"></i>
                    </div>
                    <h4 class="text-center mt-4 mb-2">Disponibilidad</h4>
                    <p class="text-center">Nuestro campus virtual permanece activo las 24 horas todos los días del año. Ingresa en el momento que lo decidas.
                    </p>
                </div>
            </div>
            <!-- end Iconos informativos -->
            <footer>
                <div class="row p-3">
                    <div class="col d-flex align-items-center">
                        <p class="text-white">Copyright © ASPEFAM 2020. All rights reserved.</p>
                    </div>
                    <div class="col socialButtons">
                        <ul class="d-flex justify-content-end align-items-center h-100">
                            <li>
                                <a href="" class="bg-facebook"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="" class="bg-twitter"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="" class="bg-fliker"><i class="fab fa-flickr"></i></a>
                            </li>
                            <li>
                                <a href="" class="bg-youtube"><i class="fab fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!--script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script-->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <script type="text/javascript">
      $(document).ready(function () {

      $('.opc-tag').click(function(){
        var tagId = $(this).data('id');
        $.ajax({
          type: "post",
          url: "/cursos/" + tagId + "",
          data: {
            _token:'{{csrf_token()}}'
          },
          success: function (response) {
            //alert("Se ha realizado el POST con exito "+data);
            if(response.success) {
              var cursos = response.data;
              $('.row-courses').empty();
              $.each(cursos, function (id, curso) {
                var course_id = curso.id;
                var tags_html = '';

                $.each(curso.tags, function (tag_id, tag) {
                  tags_html += `<i class="fas fa-circle" style="color: `+tag.color+`"></i>`
                })
                $('.row-courses').append(`
                  <div class="col mb-4 item">
                    <div class="card">
                      <a href="/detallecurso/`+course_id+`">
                        <img src="images/curso01.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <div>
                            `
                            +tags_html+
                            `
                          </div>
                          <h5 class="card-title">`+curso.shortname+`</h5>
                          <p class="card-text"></p>
                        </div>  
                      </a>
                    </div>
                  </div>
                  `);
              });
            }
          },
          error: function (request, status, error) {
            var data = jQuery.parseJSON(request.responseText);
            if (data.errors) {
              if (data.errors.name) {
                $('.name_message').text(data.errors.name);
              }
              if (data.errors.enabled) {
                $('.enabled_message').text(data.errors.enabled);
              }
              /*if (data.errors.area_id) {
                $('.area_message').text(data.errors.area_id);
              }*/
            }
          }
      });


      })
      $('.opc-tag:first').trigger('click');
      })
    </script>
  </body>
</html>