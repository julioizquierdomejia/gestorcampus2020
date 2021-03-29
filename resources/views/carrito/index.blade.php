@extends('layouts.frontend', ['title' => 'Carrito de compras'])

@section('content')
	
	<img src="{{ asset('/images/header_shopping.png') }}" class="card-img-top" alt="Imagen del curso">

	<div class="row components_content p-5">
		<div class="col">
			<h2>Datos del comprador</h2>
			<div class="alert alert-primary" role="alert">
			  <p><span style="font-weight: bold;">Nombre :</span> {{ $usuario->name }}</p>
			  <p>Apellidos : {{ $usuario->last_name }} {{ $usuario->mothers_last_name }}</p>
			  <p>Dirección : {{ $usuario->address }}</p>
			  <p>- {{ $usuario->city }}</p>
			  <p>- {{ $usuario->provincia }}</p>
			  <p>- {{ $usuario->distrito }}</p>
			  
			</div>
		</div>
	</div>

	<div class="row components_content p-5">
		<div class="col">
			<h2>Mis productos</h2>
			<table class="table table-hover mt-4">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">Identificado</th>
			      <th scope="col" style="width: 7%;">Caratula</th>
			      <th scope="col">Nombre del curso</th>
			      <th scope="col">Instructor</th>
			      <th scope="col">Pagar por curso</th>
			      <th scope="col">Quitar</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($cursos as $curso)
				    <tr>
				      <th scope="row"><span style="font-size: 24px; font-weight: bold;">{{ $curso->id }}</span></th>
				      <td><img src="{{ asset('/images/images_cursos/'.$curso->img) }}" class="card-img-top" alt="Imagen del curso"></td>
				      <td>{{ $curso->fullname }}</td>
				      <td>{{ $curso->instructor }}</td>
				      <td><a href="" class="btn btn-success btn_pagar">Pagar S/.{{ $curso->price }}</a></td>
				      <td><a href="" class="btn btn-danger"><i class="fas fa-times"></i></a></td>
				    </tr>
			    @endforeach
			  </tbody>
			</table>		
		</div>
	</div>

	<form id="form_info_cart">
      @csrf
      <input type="hidden" name="course_id" value="{{$curso->id}}">
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    </form>

	
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

    $('.btn_pagar').on('click', function(e) {
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

  //Ajax ShoopingCarts
  $('#addCart').click(function(){

    //definimos las variables con el valor de los inputs hidden del form
    //necesario para grabar en el carrito de compras 
    //ShopingCarts
    var input_curso_id = $('input[name=course_id]').val();
    var input_user_id = $('input[name=user_id]').val();

    $.ajax({
      url: "/carrito",
      method: 'POST',
      data:{
        _token:$('input[name="_token"]').val(),
        course_id : input_curso_id,
        user_id : input_user_id,
      }
    }).done(function(res){
      alert(res);
    })


  })


  </script>


@endsection