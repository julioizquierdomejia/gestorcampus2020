@extends('layouts.frontend', ['title' => 'Carrito de compras'])

@section('content')
	
	<img src="{{ asset('/images/header_shopping.png') }}" class="card-img-top" alt="Imagen del curso">

	<div class="row components_content p-5">
		<div class="col">
			<h2><i class="fas fa-user-tag text-success"></i> Datos del comprador</h2>
			<div class="alert alert-primary mt-4" role="alert">
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
			<h2><i class="fas fa-cart-arrow-down text-success"></i> Mis productos</h2>
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
			  	@forelse($cursos as $curso)
				    <tr>
				      <th scope="row"><span style="font-size: 24px; font-weight: bold;">{{ $curso->id }}</span></th>
				      <td><img src="{{ asset('/images/images_cursos/'.$curso->img) }}" class="card-img-top" alt="Imagen del curso"></td>
				      <td>{{ $curso->fullname }}</td>
				      <td>{{ $curso->instructor }}</td>
				      <td><a href="" class="btn btn-success btn_pagar">Pagar S/.{{ $curso->price }}</a></td>
				      <td><a href="#" class="btn btn-danger btn_delete_course" data-id='{{$curso->id}}' ><i class="fas fa-times"></i></a></td>
				    </tr>
            @empty
              <p>No existen registros que mostrar</p>
            @endforelse
			  </tbody>
			</table>		
		</div>

		<div class="alert alert-success mt-5" role="alert">
			<span>Pagar el total de S/ {{$precio_total}}.00 Soles</span> <a href="" class="btn btn-success btn_pagar mr-5">Aquí</a>
		</div>


	</div>

  @if ($curso->id == null)
    
  @else
    <form id="form_info_cart">
        @csrf
        <input type="hidden" name="course_id" value="{{$curso->id}}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    </form>
  @endif

	
@endsection


@section('javascript')
  
  <script type="text/javascript">
    
    Culqi.publicKey = 'pk_test_3b370432f6d56e22';

    Culqi.settings({
      title: 'ASPEFAM - Campus',
      currency: 'PEN',
      description: '{{$curso->fullname}}',
      amount: 3500
    });

    Culqi.options({
        //lang: 'auto',
        modal: true,
        //installments: true,
        //customButton: 'Donar',
        style: {
          logo: "{{ asset('/images/isotipo.png') }}",
          maincolor: '#1D1FE7',
          buttontext: '#ffffff',
          maintext: '#4A4A4A',
          desctext: '#4A4A4A'
        }
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

  //Eliminar producto dle carrito
  $('.btn_delete_course').click(function(){
  	
  	id = $(this).data('id');

  	$.ajax({
      url: "/carrito/" + id,
      method: 'DELETE',
      data:{
        _token : $('input[name="_token"]').val(),
        course_id : id,//$(this).attr(data-id),
      }
    }).done(function(res){
      alert(res);
    })

  })


  </script>


@endsection