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

  <div class="col-md-4">
    <div class="card card-user box">
      <div class="image">
        <img src="../assets/img/damir-bosnjak.jpg" alt="...">
      </div>
      <div class="card-body">
        <div class="author">
          <a href="#">
            <img class="avatar border-gray boxavatar" src="../assets/img/{{$usuario->avatar}}" alt="Avatar por defecto">
            <h5 class="title">{{Auth::user()->name}}</h5>
          </a>
          <p class="boxname">
            {{Auth::user()->email}}
          </p>
        </div>
        <p class="text-center">
          "Donde quiera que se ama el arte de la medicina
          <br>
          se ama también a la humanidad. <br>
          (Platón)."
        </p>
      </div>
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