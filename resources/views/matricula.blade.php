@extends('layouts.app')

@section('content')



<div class="row">
  <div class="col-sm-6 col-md-6 col-lg-4">
    <div class="card card-stats">
      <div class="card-header">
        <h4>Matricular a un estudiante</h4>
      </div>
      <div class="card-body">
        <form class="form-group">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Usuario</label>
                <input type="text" class="form-control" placeholder="Ingresar nombre a buscar" name='nombre' id='nombre' value="">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="update ml-auto mr-auto">
              <button type="submit" id='buscar_usuario' class="btn btn-primary btn-round">Buscar</button>
            </div>
          </div>

      </div>
    </div>
  </div>

  <div class="col-md-4 box" style="display: none;">
    <div class="card card-user">
      <div class="image">
        <img src="../assets/img/damir-bosnjak.jpg" alt="...">
      </div>
      <div class="card-body" style="min-height: 157px;">
        <div class="author">
          <img class="avatar border-gray boxavatar" src="" alt="Avatar por defecto">
          <p class="boxname">
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4 box_more_result" style="display: none;">
    <div class="card card-user">
      <div class="card-body">
        <h5>Resultados</h5>

        <div class="list-group multi_usuarios_lista">

          
        </div>
        
      </div>
    </div>
  </div>


</div>

<div class="row">
  <div class="col-md-12">
    <h4 class="mb-5"> Seleccione el Curso a matricularse</h4>
      <div class="row row-cols-1 row-cols-md-6">
        @foreach($cursosVisibles as $curso)
          <div class="col mb-4">
            <a class="card_curso">
              <div class="card card_cursos_select">
                <div class="overall"></div>
                <div class="card-body">
                  <h5 class="card-title"><span>Curso : </span>{{ $curso->shortname }}</h5>
                  <p class="card-text"></p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Relación de Matriculados</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table" id="tabla">
            <thead class=" text-primary">
              <th>
                Name
              </th>
              <th>
                Country
              </th>
              <th>
                City
              </th>
              <th class="text-right">
                Estado
              </th>
            </thead>
            <tbody>
              @foreach($cursosVisibles as $curso)
              <tr>
                <td>
                  {{ $curso->shortname }}
                </td>
                <td>
                  Niger
                </td>
                <td>
                  Oud-Turnhout
                </td>
                <td class="text-right">
                  {{ $curso->visible }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection