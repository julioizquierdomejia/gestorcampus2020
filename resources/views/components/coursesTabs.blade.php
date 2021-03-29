<div class="row components_content">
  <div class="col">
    <div class="row px-5 pt-3">
      <div class="col">
        <h2 class="title-seccion">Nuestros Cursos</h2>

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
              <div class="row row-cols-1 row-cols-md-4 row-courses">
                @foreach($cursos as $curso)
                  @if($curso->course_group_id == $grupo[0] )
                    <div class="col mb-4 item">
                      <div class="card">
                        <a href=" {{ route('curso.detail', $curso->id) }}">
                          <img src="images/images_cursos/{{$curso->img}}" class="card-img-top" alt="...">
                          <div class="card-body">
                            <div>
                              @foreach($cuorse_tags as $key => $tag)
                                @if($tag->course_id == $curso->id)
                                  <i class="fas fa-circle" style="color: {{$tag->color}}"> <span style="font-family: Arial">{{ $tag->name }}</span> </i>
                                @endif
                              @endforeach
                            </div>
                            <h5 class="card-title mt-2">{{ $curso->fullname  }}</h5>
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
      </div>
    </div>
      <!-- Fin de Contenido de las pestañas lista de cursos -->
  </div>
</div>