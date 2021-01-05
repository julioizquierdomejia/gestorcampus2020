@extends('layouts.app')

@section('content')

<div class="row">

  <div class="col-md-8">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">
        Editar Perfil</h5>
      </div>
      <div class="card-body">
        <form class="form-group" method="POST" action="{{route('user.update', $usuario)}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input name='datauser' type="hidden" class="form-control" placeholder="" value="1">
          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label>Usuario</label>
                <input type="text" class="form-control" disabled="" placeholder="" value="{{Auth::user()->email}}">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Documento</label>
                <input name='document' type="text" class="form-control" disabled="" placeholder="" value="{{Auth::user()->document}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Nombres</label>
                <input name='name' type="text" class="form-control" placeholder="Ingrese Nombre" value="{{$usuario->name}}">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Apellido Paterno</label>
                <input name='last_name' type="text" class="form-control" placeholder="Ingrese Apellido Paterno" value={{$usuario->last_name}}>

                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Apellidos Materno</label>
                <input name='mothers_last_name' type="text" class="form-control" placeholder="Ingrese Apellido Materno" value="{{$usuario->mothers_last_name}}">

                @error('mothers_last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <label>Sexo</label>
              <div class="form-group">
                <div class="form-check form-check-radio form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="sexo" id="m" value="1"
                    @if($usuario->sexo == '1')
                      checked
                    @endif
                    > Masculino
                    <span class="form-check-sign"></span>
                  </label>
                </div>
                <div class="form-check form-check-radio form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="sexo" id="f" value="2"
                    @if($usuario->sexo == '2')
                      checked
                    @endif
                    > Femenino
                    <span class="form-check-sign"></span>
                  </label>
                </div>
              </div>
            </div>
          </div>

          
          <!--div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>About Me</label>
                <textarea class="form-control textarea">Oh so, your weak rhyme You doubt I'll bother, reading into it</textarea>
              </div>
            </div>
          </div-->
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
        <h5 class="card-title">
        Información Personal</h5>
      </div>
      <div class="card-body">
        <form class="form-group" method="POST" action="{{route('user.update', $usuario)}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input name='datauser' type="hidden" class="form-control" placeholder="" value="2">
          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label>Dirección</label>
                <input name='address' type="text" class="form-control" placeholder="Ingresa Dirección" value="{{$usuario->address}}">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Urbanización</label>
                <input name='urbanizacion' type="text" class="form-control" placeholder="Ingresa Urbanización" value="{{$usuario->urbanizacion}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Distrito</label>
                <input name='distrito' type="text" class="form-control" placeholder="Ingrese Distrito" value="{{$usuario-> distrito}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Ciudad</label>
                <input name='city' type="text" class="form-control" placeholder="Ingrese Ciudad" value="{{$usuario->city}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Provincia</label>
                <input name='provincia' type="text" class="form-control" placeholder="Ingrese Provincia" value="{{$usuario->provincia}}">
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

    <!-- 
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Cambiar Contraseña</h5>
      </div>
      <div class="card-body">
        <form class="form-group" method="POST" action="{{route('user.update', $usuario)}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input name='datauser' type="hidden" class="form-control" placeholder="" value="3">
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
                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
          	<div class="col-md-6">
              <div class="form-group">
                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="update ml-auto mr-auto">
              <button id='btn-cambiar-pass' class="btn btn-primary btn-round">Cambiar Contraseña</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    -->


  </div>
  <div class="col-md-4">
    <div class="card card-user">
      <div class="image">
        <img src="../assets/img/damir-bosnjak.jpg" alt="...">
      </div>
      <div class="card-body">
        <div class="author">
          <a href="#">
            <img class="avatar border-gray" src="../assets/img/{{$usuario->avatar}}" alt="Avatar por defecto">
            <h5 class="title">{{Auth::user()->name}}</h5>
          </a>
          <p class="description">
            {{Auth::user()->email}}
          </p>
        </div>
        <p class="description text-center">
          "Donde quiera que se ama el arte de la medicina
          <br>
          se ama también a la humanidad. <br>
          (Platón)."
        </p>
      </div>
    </div>
  </div>
</div>

@endsection