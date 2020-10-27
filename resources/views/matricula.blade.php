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

  <div class="col-md-4 box_my_courses">
    <div class="card card-user">
      <div class="card-body">
        <h5>Mis Cursos</h5>

        <div class="list-group my_courses_lista">

        </div>
        
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
      <div class="card-body card_table_courses">
        
      </div>
    </div>
  </div>
</div>


<!-- Modal de confirmacion de Matrícula -->
<div class="modal" tabindex="-1" role="dialog" id="modalMatricula">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmación de Matrícula</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




@endsection