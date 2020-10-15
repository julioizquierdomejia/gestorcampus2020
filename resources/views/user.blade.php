@extends('layouts.app')

@section('content')

<div class="row">

  <div class="col-md-8">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Editar Perfil</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label>Usuario</label>
                <input type="text" class="form-control" disabled="" placeholder="Company" value={{Auth::user()->email}}>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Documento</label>
                <input type="text" class="form-control" placeholder="Username" value={{Auth::user()->document}}>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Nombres</label>
                <input type="text" class="form-control" placeholder="Company" value={{$usuario->name}}>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Apellido Paterno</label>
                <input type="text" class="form-control" placeholder="Company" value={{$usuario->last_name}}>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Apellidos Materno</label>
                <input type="text" class="form-control" placeholder="Last Name" value={{$usuario->mothers_last_name}}>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>About Me</label>
                <textarea class="form-control textarea">Oh so, your weak rhyme You doubt I'll bother, reading into it</textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="update ml-auto mr-auto">
              <button type="submit" class="btn btn-primary btn-round">Actualizar</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Cambiar Contraseña</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Contraseña Actual</label>
                <input type="text" class="form-control" placeholder="" value=''>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nueva Contraseña</label>
                <input type="text" class="form-control" placeholder="" value=''>
              </div>
            </div>
          </div>
          <div class="row">
          	<div class="col-md-6">
              <div class="form-group">
                <label>Repetir Nueva Contraseña</label>
                <input type="text" class="form-control" placeholder="" value=''>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="update ml-auto mr-auto">
              <button type="submit" class="btn btn-primary btn-round">Cambiar Contraseña</button>
            </div>
          </div>
        </form>
      </div>
    </div>


  </div>
  <div class="col-md-4">
    <div class="card card-user">
      <div class="image">
        <img src="../assets/img/damir-bosnjak.jpg" alt="...">
      </div>
      <div class="card-body">
        <div class="author">
          <a href="#">
            <img class="avatar border-gray" src="../assets/img/p_jc.jpeg" alt="...">
            <h5 class="title">{{Auth::user()->name}}</h5>
          </a>
          <p class="description">
            {{Auth::user()->email}}
          </p>
        </div>
        <p class="description text-center">
          "I like the way you work it <br>
          No diggity <br>
          I wanna bag it up"
        </p>
      </div>
      <div class="card-footer">
        <hr>
        <div class="button-container">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-6 ml-auto">
              <h5>12<br><small>Files</small></h5>
            </div>
            <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
              <h5>2GB<br><small>Used</small></h5>
            </div>
            <div class="col-lg-3 mr-auto">
              <h5>24,6$<br><small>Spent</small></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Team Members</h4>
      </div>
      <div class="card-body">
        <ul class="list-unstyled team-members">
          <li>
            <div class="row">
              <div class="col-md-2 col-2">
                <div class="avatar">
                  <img src="../assets/img/faces/ayo-ogunseinde-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
              </div>
              <div class="col-md-7 col-7">
                DJ Khaled
                <br />
                <span class="text-muted"><small>Offline</small></span>
              </div>
              <div class="col-md-3 col-3 text-right">
                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
              </div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-2 col-2">
                <div class="avatar">
                  <img src="../assets/img/faces/joe-gardner-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
              </div>
              <div class="col-md-7 col-7">
                Creative Tim
                <br />
                <span class="text-success"><small>Available</small></span>
              </div>
              <div class="col-md-3 col-3 text-right">
                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
              </div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-2 col-2">
                <div class="avatar">
                  <img src="../assets/img/faces/clem-onojeghuo-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
              </div>
              <div class="col-ms-7 col-7">
                Flume
                <br />
                <span class="text-danger"><small>Busy</small></span>
              </div>
              <div class="col-md-3 col-3 text-right">
                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

@endsection